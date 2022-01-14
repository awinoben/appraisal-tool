<?php

namespace App\Http\Livewire\Inc;

use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;

class TopNav extends Component
{
    use FindGuard;

    public $user;

    public function mount()
    {
        $this->user = $this->findGuardType()->user();
    }

    public function logout()
    {
        $this->findGuardType()->logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.inc.top-nav');
    }
}
