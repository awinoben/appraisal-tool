<div>
    <div class="container-fluid page-body-wrapper">
        <livewire:inc.side-nav/>

        <!-- partial -->
        <div class="main-panel my_top_margin">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Team List </h3>
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
                                    @if(count($teams))
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Team Name</th>
                                                <th scope="col">Supervisor Name</th>
                                                <th scope="col">Supervisor Email</th>
                                                <th scope="col">Team Employees</th>
                                                <th scope="col">Date/Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($count = 1)
                                            @foreach($teams as $team)
                                                <tr>
                                                    <th scope="row">{{ $count++ }}</th>
                                                    <td>{{ $team->name }}</td>
                                                    <td>{{ $team->user->name }}</td>
                                                    <td>{{ $team->user->email }}</td>
                                                    <td>{{ number_format(count($team->team_user)) }}</td>
                                                    <td>{{ date('F d, Y h:i', strtotime($team->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col-md-12">
                                            {{ $teams->links() }}
                                        </div>
                                    @else
                                        <center>
                                            <hr>
                                            <p>No Teams Were Found</p>
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
