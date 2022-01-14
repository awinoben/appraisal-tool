<?php

namespace App\Http\Livewire\Branch;

use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;

class ViewBranch extends Component
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
        return view('livewire.branch.view-branch', [
            'branches' => $this->readyToLoad
                ? Branch::query()
                    ->with(['user'])
                    ->latest()
                    ->where(function ($query) {
                        $query->orWhere('name', 'ilike', '%' . $this->search . '%');
                    })
                    ->paginate(50)
                : []
        ]);
    }
}
