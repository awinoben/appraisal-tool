<?php

namespace App\Http\Livewire\Team;

use App\Models\Team;
use Livewire\Component;
use Livewire\WithPagination;

class TeamList extends Component
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
        return view('livewire.team.team-list', [
            'teams' => $this->readyToLoad
                ? Team::query()
                    ->with([
                        'user',
                        'team_user',
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
