@if($type_of_report === 'performance_objectives')
    <table>
        <thead>
        <tr>
            <th>Country</th>
            <th>Branch</th>
            <th>Employee Number</th>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Designation</th>
            <th>Date Of Joining</th>
            <th>Department</th>
            <th>Manager</th>
            <th>KRA's And KPI's</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->branch->name }}</td>
                <td>{{ $user->country->name }}</td>
                <td>{{ $user->employee_number }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ \Carbon\Carbon::parse($user->joining_date)->format('d/m/Y') }}</td>
                <td>{{ count($user->assigned_project) ? $user->assigned_project->first()->project->name : '' }}</td>
                <td>{{ count($user->assigned_project) ? $user->assigned_project->first()->project->user->name : '' }}</td>
                <td>
                    @if (count($user->report))
                        <table>
                            <thead>
                            <tr>
                                <th>KRA And KPI</th>
                                <th>Self Rating</th>
                                <th>Self Remarks</th>
                                <th>Supervisor Rating</th>
                                <th>Supervisor Remarks</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->report as $report)
                                <tr>
                                    <td>{{ $report->key_result_area->name }}</td>
                                    <td>{{ $report->self_rating }}</td>
                                    <td>{{ $report->self_remarks }}</td>
                                    <td>{{ $report->appraiser_rating }}</td>
                                    <td>{{ $report->appraiser_remarks }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        Not Available
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <table>
        <thead>
        <tr>
            <th>Country</th>
            <th>Branch</th>
            <th>Employee Number</th>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Designation</th>
            <th>Date Of Joining</th>
            <th>Department</th>
            <th>Manager</th>
            @foreach(config('appraisal.personal_main') as $personal)
                <th>{{ $personal }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->branch->name }}</td>
                <td>{{ $user->country->name }}</td>
                <td>{{ $user->employee_number }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ \Carbon\Carbon::parse($user->joining_date)->format('d/m/Y') }}</td>
                <td>{{ count($user->assigned_project) ? $user->assigned_project->first()->project->name : '' }}</td>
                <td>{{ count($user->assigned_project) ? $user->assigned_project->first()->project->user->name : '' }}</td>
                <td>
                    @if (count($user->personal_development))
                        <table>
                            <thead>
                            <tr>
                                <th colspan="1"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->personal_development as $personal_development)
                                <tr>
                                    <td>{{ $personal_development->personal_development }}</td>
                                    <td>{{ $personal_development->what_to_do }}</td>
                                    <td>{{ $personal_development->achievement }}</td>
                                    <td>{{ $personal_development->actions }}</td>
                                    <td>{{ $personal_development->manager_comments }}</td>
                                    <td>{{ $personal_development->on_track }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        Not Available
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
