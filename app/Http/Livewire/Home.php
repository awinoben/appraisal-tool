<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Home extends Component
{
    public bool $readyToLoad = false;

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function data()
    {
        $users = new User();

        return [
            'users' => number_format(count($users->get())),
            'pending' => number_format(count($users->where('is_evaluated', false)->where('is_self_evaluated', false)->get())),
            'self' => number_format(count($users->where('is_evaluated', false)->where('is_self_evaluated', true)->get())),
            'appraised' => number_format(count($users->where('is_evaluated', true)->where('is_self_evaluated', true)->get())),
        ];
    }

    public function render()
    {
        return view('livewire.home', [
            'data' => $this->readyToLoad ? self::data() : []
        ]);
    }
}
