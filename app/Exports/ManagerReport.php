<?php

namespace App\Exports;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ManagerReport implements FromView
{
    public function view(): View
    {
        return view('export.manager', [
            'projects' => Project::query()
                ->with([
                    'country',
                    'user',
                    'assigned_project.user'
                ])
                ->latest()
                ->get()
        ]);
    }
}
