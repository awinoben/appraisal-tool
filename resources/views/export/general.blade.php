@if(count($users))
    <table>
        <thead>
        <tr>
            <th>Country</th>
            <th>Branch</th>
            <th>SAP NO</th>
            <th>Full Name</th>
            <th>Email Address</th>
            <th>Designation</th>
            <th>DOJ</th>
            <th>Department</th>
            <th>Manager</th>
            @foreach($users->first()->report as $report)
                <th>{{ $report->key_result_area->name }}</th>
            @endforeach
            @foreach(config('appraisal.personal') as $personal)
                <th>{{ $personal }}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @php($report_number = count($users->first()->report))
            @php($personal_development_number = count($users->first()->personal_development))

            @if((count($user->personal_development) && count($user->report)))
                <tr>
                    <td>{{ $user->branch->name }}</td>
                    <td>{{ $user->country->name }}</td>
                    <td>{{ $user->employee_number }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->employee_designation }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->joining_date)->format('d/m/Y') }}</td>
                    @php($count = 1)
                    @foreach($user->report as $report)
                        @if($report_number > 0)
                            @if($count == 1)
                                <td>{{ $report->project->name }}</td>
                                <td>{{ $report->project->user->name }}</td>
                            @endif
                            <td>{{ $report->appraiser_rating }}</td>
                            @php($count++)
                        @endif
                        @php($report_number--)
                    @endforeach
                    @foreach($user->personal_development as $personal_development)
                        @if($personal_development_number > 0)
                            <td>{{ $personal_development->personal_development }}</td>
                            <td>{{ $personal_development->what_to_do }}</td>
                            <td>{{ $personal_development->achievement }}</td>
                            <td>{{ $personal_development->actions }}</td>
                            <td>{{ $personal_development->manager_comments }}</td>
                            <td>{{ $personal_development->on_track }}</td>
                        @endif
                        @php($personal_development_number--)
                    @endforeach
                </tr>
            @else
                <tr></tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endif
