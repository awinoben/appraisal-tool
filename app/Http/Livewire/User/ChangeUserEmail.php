<?php

namespace App\Http\Livewire\User;

use App\Jobs\MailJob;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ChangeUserEmail extends Component
{
    use LivewireAlert;

    public $old_email;
    public $new_email;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected function rules(): array
    {
        return [
            'old_email' => ['required', 'string', 'email', 'max:255', 'exists:users,email'],
            'new_email' => ['required', 'string', 'email', 'max:255', 'unique:users,email']
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
        $user = User::query()->firstWhere('email', $this->old_email);
        $user->update([
            'email' => $this->new_email,
            'password' => bcrypt($user->employee_number),
        ]);

        // do a refresh
        $user->refresh();

        // dispatch mail job
        dispatch((new MailJob(
            $user->email,
            'Java House PDP Account & Tutorial',
            $user->name,
            "Your account username is '.$user->email.', Your account password is '.$user->employee_number.' .Kindly use it to log in by clicking on the link below.",
            env('FRONTEND_URL'),
            '<<< LOGIN >>>',
            "Click on the link below for a tutorial on how to fill in your appraisal - https://stonly.com/guide/en/self-evaluation-LNVE0e1CAu/Steps/697676"
        )))->onQueue('emails')->delay(1);

        $this->reset();
        $this->alert('success', 'Successfully changed email to ' . $this->new_email);
    }

    public function cancelled()
    {
        $this->alert('error', 'You have canceled.');
    }

    public function render()
    {
        return view('livewire.user.change-user-email');
    }
}
