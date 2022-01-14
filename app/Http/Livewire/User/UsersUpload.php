<?php

namespace App\Http\Livewire\User;

use App\Jobs\UploadJob;
use App\Traits\CsvRules;
use App\Traits\CsvValidator;
use App\Traits\StoreCsvData;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use World\Countries\Model\Country;

class UsersUpload extends Component
{
    use WithFileUploads, CsvValidator, StoreCsvData, CsvRules, LivewireAlert;

    public $country_id;
    public $catalogue;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    protected array $rules = [
        'catalogue' => ['required', 'mimes:csv,txt', 'max:100000'], // maximum upload size is 100MBs
        'country_id' => ['required', 'string', 'exists:countries,id'],
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
     * upload file and send sms here
     * @throws Exception
     */
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
        // generate unique name
        $name = Str::random(10) . '.csv';

        // Store in the "public" directory with the filename "name generated".
        $this->catalogue->storeAs('public', $name);

        try {
            $csvValidator = $this->open(storage_path('app/public/' . $name), $this->uploadEmployeeRules());
            if ($csvValidator->fails()) {
                Log::emergency($csvValidator->getErrors());
                $this->alert('error', 'An error occurred during data extracting. Check the data and try again.');
                return redirect()->back();
            }

            // get the extracted data
            $this->csvData = $csvValidator->getData();
        } catch (Exception $exception) {
            Log::emergency($exception->getMessage());
            $this->alert('error', 'An error occurred. Download the file template to have a look on how to design the upload.');
            return redirect()->back();
        }

        // unlink the media here after upload
        unlink(storage_path('app/public/' . $name));

        try {
            // store the extracted data temporarily
            $id = $this->storeCsvData($name, $this->csvData, now());
        } catch (Exception $exception) {
            Log::emergency($exception->getMessage());
            $this->alert('error', 'An error occurred. During data extraction.');
            return redirect()->back();
        }

        // queue for the job to do the heavy lifting
        dispatch(new UploadJob(
            $id,
            $name,
            $this->country_id
        ))->onQueue('uploads')->delay(1);

        $this->reset();
        $this->alert('success', 'Successfully uploaded ' . count($this->csvData) . ' employee(s).');

        return redirect()->back();
    }

    public function cancelled()
    {
        $this->alert('error', 'You have canceled.');
    }

    public function render()
    {
        return view('livewire.user.users-upload', [
            'countries' => Country::query()->orderBy('name')->get(),
        ]);
    }
}
