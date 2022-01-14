<?php

namespace App\Exports;

use App\Models\AssignedProject;
use App\Models\User;
use Bugsnag\DateTime\Date;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    /**
     * @param string $project_id
     * @param Date|string $from_date
     * @param Date|string $to_date
     * @param string $type_of_report
     */
    public function __construct(
        private string      $project_id,
        private Date|string $from_date,
        private Date|string $to_date,
        private string      $type_of_report,
    )
    {
    }

    public function view(): View
    {
        return view('export.report', [
            'users' => User::query()
                ->with([
                    'branch',
                    'role',
                    'country',
                    'project.user',
                    'report.project.user',
                    'report.key_result_area',
                    'personal_development',
                    'result',
                    'assigned_project.project.user'
                ])
                ->where('is_evaluated', true)
                ->whereIn('id',
                    AssignedProject::query()
                        ->where('project_id', $this->project_id)
                        ->get('user_id')->toArray()
                )
                ->whereDate('updated_at', '>=', date('Y-m-d', strtotime($this->from_date)))
                ->whereDate('updated_at', '<=', date('Y-m-d', strtotime($this->to_date)))
                ->latest('updated_at')
                ->get(),
            'type_of_report' => $this->type_of_report
        ]);
    }
}
