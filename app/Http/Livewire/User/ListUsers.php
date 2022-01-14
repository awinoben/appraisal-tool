<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination, LivewireAlert;

    public $search;
    public $user_id;

    protected $queryString = ['search'];

    protected string $paginationTheme = 'bootstrap';

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public bool $readyToLoad = false;

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function revoke(string $id)
    {
        $this->user_id = $id;
        $this->confirm('Are you sure you want to proceed?', [
            'toast' => false,
            'position' => 'center',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Yes, I am sure!',
            'cancelButtonText' => 'No, cancel it!',
            'onConfirmed' => 'confirmed',
            'onDismissed' => 'cancelled'
        ]);
    }

    public function confirmed()
    {
        // fetch user to revoke
        $user = User::query()->with([
            'assigned_project',
            'report',
            'personal_development',
            'escalate'
        ])->findOrFail($this->user_id);

        // soft delete the following
        if (count($user->assigned_project))
            $user->assigned_project->delete();
        if (count($user->report))
            $user->report->delete();
        if (count($user->personal_development))
            $user->personal_development->delete();
        if (count($user->escalate))
            $user->escalate->delete();

        $user->delete();

        $this->loadData();
        $this->alert('success', 'You have successfully removed all details for ' . $user->name);
    }

    public function cancelled()
    {
        $this->alert('error', 'You have canceled.');
    }

    public function render()
    {
        return view('livewire.user.list-users', [
            'users' => $this->readyToLoad
                ? User::query()
                    ->with([
                        'branch',
                        'assigned_project.project',
                        'country',
                        'role'
                    ])
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhereRelation('country', 'name', 'ilike', '%' . $this->search . '%')
                            ->orWhereRelation('country', 'slug', 'ilike', '%' . $this->search . '%')
                            ->orWhereRelation('role', 'name', 'ilike', '%' . $this->search . '%')
                            ->orWhereRelation('role', 'slug', 'ilike', '%' . $this->search . '%')
                            ->orWhereRelation('branch', 'name', 'ilike', '%' . $this->search . '%')
                            ->orWhereRelation('branch', 'slug', 'ilike', '%' . $this->search . '%')
                            ->orWhere('email', 'ilike', '%' . $this->search . '%')
                            ->orWhere('employee_number', 'ilike', '%' . $this->search . '%')
                            ->orWhere('employee_designation', 'ilike', '%' . $this->search . '%')
                            ->orWhere('name', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(50)
                : []
        ]);
    }
}
