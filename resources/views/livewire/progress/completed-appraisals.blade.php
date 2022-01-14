<div>
    <div class="container-fluid page-body-wrapper">
        <livewire:inc.side-nav/>

        <!-- partial -->
        <div class="main-panel my_top_margin">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Self Appraised Employees List </h3>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card" wire:poll.keep-alive>
                        <div class="card">
                            <div class="card-body">
                                <div class="input-group">
                                    <input type="search" class="form-control" placeholder="Search..."
                                           wire:model="search"
                                           wire:offline.attr="disabled"
                                           aria-label="Search..." aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-gradient-primary" type="button" disabled>Search
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive" wire:init="loadData">
                                    @if(count($users))
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Country</th>
                                                <th scope="col">Branch</th>
                                                <th scope="col">Department</th>
                                                <th scope="col">Designation</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Email Address</th>
                                                <th scope="col">Employee Number</th>
                                                <th scope="col">Self Appraised</th>
                                                <th scope="col">Appraised</th>
                                                <th scope="col">Joined On</th>
                                                <th scope="col">Date/Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($count = 1)
                                            @foreach($users as $user)
                                                <tr>
                                                    <th scope="row">{{ $count++ }}</th>
                                                    <td>{{ $user->country->name }}</td>
                                                    <td>{{ $user->branch->name }}</td>
                                                    <td>
                                                        @if (count($user->assigned_project))
                                                            {{ $user->assigned_project()->first()->project->name }}
                                                        @else
                                                            <span class="badge badge-danger">not available</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $user->role->name }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->employee_number }}</td>
                                                    <td>
                                                        @if ($user->is_self_evaluated)
                                                            <span class="badge badge-success">yes</span>
                                                        @else
                                                            <span class="badge badge-danger">no</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($user->is_evaluated)
                                                            <span class="badge badge-success">yes</span>
                                                        @else
                                                            <span class="badge badge-danger">no</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (isset($user->joining_date))
                                                            {{ date('F d, Y', strtotime($user->joining_date)) }}
                                                        @else
                                                            <span class="badge badge-danger">Not Available</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ date('F d, Y h:i', strtotime($user->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col-md-12">
                                            {{ $users->links() }}
                                        </div>
                                    @else
                                        <center>
                                            <hr>
                                            <p>No data available yet</p>
                                            <hr>
                                        </center>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            <livewire:inc.footer/>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
</div>
