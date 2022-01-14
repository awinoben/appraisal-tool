<?php

namespace App\Http\Livewire\Department;

use App\Models\Project;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AddDepartment extends Component
{
    use LivewireAlert;

    public $name;
    public $hod_email;
    public $supervisor_email;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected function rules(): array
    {
        return [
            'hod_email' => ['required', 'string', 'email', 'exists:users,email'],
            'name' => ['required', 'string', 'max:255', 'unique:projects'],
            'supervisor_email' => ['required', 'string', 'email', 'exists:users,email']
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
        $user = User::query()->firstWhere('email', $this->hod_email);

        Project::query()->create([
            'country_id' => $user->country_id,
            'user_id' => $user->id,
            'name' => $this->name,
            'supervisor_emails' => [$this->supervisor_email],
        ]);

        $this->reset();
        $this->alert('success', 'Successfully created nw department.');
    }

    public function cancelled()
    {
        $this->alert('error', 'You have canceled.');
    }

    public function render()
    {
        return view('livewire.department.add-department');
    }
}
