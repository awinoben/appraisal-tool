<div>
    <div class="container-fluid page-body-wrapper">
        <livewire:inc.side-nav/>

        <!-- partial -->
        <div class="main-panel my_top_margin">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> List Branches </h3>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card" wire:poll.120000ms>
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
                                    @if(count($branches))
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Branch Name</th>
                                                <th scope="col">Employees</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php($count = 1)
                                            @foreach($branches as $branch)
                                                <tr>
                                                    <th scope="row">{{ $count++ }}</th>
                                                    <td>{{ $branch->name }}</td>
                                                    <td>{{ number_format(count($branch->user)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="col-md-12">
                                            {{ $branches->links() }}
                                        </div>
                                    @else
                                        <center>
                                            <hr>
                                            <a href="{{ route('add.branch') }}" class="btn btn-link">Add
                                                Branch</a>
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
