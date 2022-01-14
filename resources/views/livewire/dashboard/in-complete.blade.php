<div>
    <div class="container">
        <div wire:loading>
            <div class="d-flex align-items-center text-primary text-center">
                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>
        <div class="py-5 text-center">
            <hr>
            <h2>Users With InComplete Appraisal</h2>
            <hr>
            <div class="form-group">
                <input class="form-control" wire:model="search" type="text" placeholder="Search...">
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <div wire:init="loadUsers">
                            @if(count($users))
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Project</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Employee Number</th>
                                        <th scope="col">Email Address</th>
                                        <th scope="col">Created On</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($count = 1)
                                    @foreach($users as $user)
                                        <tr>
                                            <th scope="row">{{ $count++ }}</th>
                                            <td>{{ $user->country->name }}</td>
                                            <td>
                                                @if(count($user->assigned_project))
                                                    {{ $user->assigned_project()->first()->project->name }}
                                                @else
                                                    No assigned project
                                                @endif
                                            </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->role->name }}</td>
                                            <td>{{ $user->employee_number }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ date('F d, Y h:i a', strtotime($user->updated_at)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <center>
                                    <hr>
                                    <h2 class="text-center">No User(s) Have In-Completed Appraisal</h2>
                                    <hr>
                                </center>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
