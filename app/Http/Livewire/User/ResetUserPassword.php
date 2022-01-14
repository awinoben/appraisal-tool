<?php

namespace App\Http\Livewire\User;

use App\Jobs\MailJob;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ResetUserPassword extends Component
{
    use LivewireAlert;

    public $email;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'exists:users']
        ];
    }

    /**
     * D0 real time validations
     * @param $propertyName
     * @throws ValidationException
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function submit()
    {
        $this->validate();
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
        // generate random password
        $password = Str::upper(Str::random(6));

        $user = User::query()->firstWhere('email', $this->email);
        $user->update([
            'password' => bcrypt($password)
        ]);

        // dispatch mail job
        dispatch((new MailJob(
            $user->email,
            'Java House PDP Account',
            $user->name,
            'Your account password is ' . $password . ' .Kindly use it to log in.',
            env('FRONTEND_URL'),
            '<<< LOGIN >>>'
        )))->onQueue('emails')->delay(1);

        $this->reset();
        $this->alert('success', 'Password for ' . $user->email . ' has been reset.');
    }

    public function cancelled()
    {
        $this->alert('error', 'You have canceled.');
    }

    public function render()
    {
        return view('livewire.user.reset-user-password');
    }
}
