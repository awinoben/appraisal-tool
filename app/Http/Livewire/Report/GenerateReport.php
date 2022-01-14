<?php

namespace App\Http\Livewire\Report;

use App\Jobs\ReportGeneratingJob;
use App\Models\AppraisalReport;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use LaravelMultipleGuards\Traits\FindGuard;
use Livewire\Component;

class GenerateReport extends Component
{
    use FindGuard, LivewireAlert;

    public $department;
    public $type_of_report;
    public $from_date;
    public $to_date;

    public $readyToLoad = false;

    protected $listeners = [
        'confirmed',
        'cancelled'
    ];

    public function loadReport()
    {
        $this->readyToLoad = true;
    }

    protected array $rules = [
        'type_of_report' => ['string', 'required'],
        'department' => ['string', 'required'],
        'from_date' => ['date', 'required', 'before:tomorrow'],
        'to_date' => ['date', 'required', 'after_or_equal:from_date', 'before:tomorrow']
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

    public function generateReport()
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
        $user = $this->findGuardType()->user()->load('appraisal_report', 'country');

        // check if user has a report
        if (!$user->appraisal_report) {
            // create a report here
            AppraisalReport::query()->create([
                'user_id' => $user->id,
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'path_name' => 'appraisal-report-' . date('Y-m-d', strtotime($this->from_date)) . '-to-' . date('Y-m-d', strtotime($this->to_date)) . '-' . Str::slug(Str::lower(Str::random(6))) . '.xlsx',
            ]);
        } else {
            $user->appraisal_report->update([
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'is_ready' => false
            ]);
        }

        // dispatch job generating
        dispatch(new ReportGeneratingJob(
            $this->findGuardType()->id(),
            $this->department,
            $this->from_date,
            $this->to_date,
            $this->type_of_report
        ))->onQueue('reports')->delay(1);

        $this->reset();
        $this->loadReport();
        $this->alert('success', 'Report for is being generated...');
    }

    public function cancelled()
    {
        $this->alert('error', 'You have canceled.');
    }

    public function render()
    {
        return view('livewire.report.generate-report', [
            'report' => $this->readyToLoad
                ? $this->findGuardType()->user()->load('appraisal_report')->appraisal_report
                : null,
            'projects' => $this->readyToLoad
                ? Project::query()->get()
                : [],
        ]);
    }
}
