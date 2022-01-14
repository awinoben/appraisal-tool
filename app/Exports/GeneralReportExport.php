<?php

namespace App\Exports;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GeneralReportExport implements FromView
{
    /**
     * @param string $role_id
     * @param bool $is_general
     */
    public function __construct(
        private string $role_id,
        private bool   $is_general = false
    )
    {
    }

    public function view(): View
    {
        return view('export.general', [
            'users' => User::query()
                ->with([
                    'branch',
                    'role',
                    'country',
                    'project.user',
                    'report.project.user',
                    'report.key_result_area',
                    'personal_development',
                    'behavioral',
                    'leader_ship',
                    'result',
                    'assigned_project.project.user'
                ])
                ->where('is_evaluated', true)
                ->whereIn('role_id',
                    $this->is_general ? Role::query()
                        ->select('id')
                        ->get()
                        ->toArray() :
                        [$this->role_id]
                )
                ->latest()
                ->get()
        ]);
    }
}
