<?php

namespace App\Http\Livewire\Department;

use App\Models\Project;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentHeads extends Component
{
    use WithPagination, LivewireAlert;

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
        return view('livewire.department.department-heads', [
            'projects' => $this->readyToLoad
                ? Project::query()
                    ->with([
                        'user',
                        'assigned_projects'
                    ])
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhereRelation('user', 'name', 'ilike', '%' . $this->search . '%')
                            ->orWhereRelation('user', 'slug', 'ilike', '%' . $this->search . '%')
                            ->orWhereRelation('user', 'email', 'ilike', '%' . $this->search . '%')
                            ->orWhereRelation('user', 'employee_number', 'ilike', '%' . $this->search . '%')
                            ->orWhere('name', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(50)
                : []
        ]);
    }
}
