<?php

namespace App\Http\Livewire;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $remember;

    public function mount()
    {
        // check if user is already authorized
        if (Auth::check())
            return redirect()->intended('home');
    }

    protected array $rules = [
        'email' => ['required', 'string', 'exists:users', 'email', 'max:255'],
        'password' => ['required', 'string'],
    ];

    /**
     * D0 real time validations
     * @param $propertyName
     * @throws ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    /**
     * login the user here
     * @return RedirectResponse
     */
    public function loginUser()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password, 'is_active' => 1], $this->remember)) {
            // Authentication passed...
            return redirect()->intended('home');
        }

        $this->reset(['password']);
        session()->flash('error', 'The credentials given don\'t match our records.');
    }

    public function render()
    {
        return view('livewire.login');
    }
}
