<table>
    <thead>
    <tr>
        <th>Country</th>
        <th>Project Name</th>
        <th>Manager Name</th>
        <th>Project Members</th>
        <th>Evaluated Members</th>
        <th>Un-Evaluated Members</th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        @php($evaluated = 0)
        @php($un_evaluated = 0)
        @foreach($project->assigned_project as $assigned_project)
            @if($assigned_project->user->is_active)
                @if($assigned_project->user->is_evaluated)
                    @php($evaluated++)
                @else
                    @php($un_evaluated++)
                @endif
            @endif
        @endforeach
        <tr>
            <td>{{ $project->country->name }}</td>
            <td>{{ $project->name }}</td>
            <td>{{ $project->user ? $project->user->name : '' }}</td>
            <td>{{ number_format($evaluated + $un_evaluated) }}</td>
            <td>{{ number_format($evaluated) }}</td>
            <td>{{ number_format($un_evaluated) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
