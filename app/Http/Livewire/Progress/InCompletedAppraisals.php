<?php

namespace App\Http\Livewire\Progress;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class InCompletedAppraisals extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = ['search'];

    protected string $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public bool $readyToLoad = false;

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function render()
    {
        return view('livewire.progress.in-completed-appraisals', [
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
                    ->where('is_evaluated', false)
                    ->where('is_self_evaluated', false)
                    ->paginate(50)
                : []
        ]);
    }
}
