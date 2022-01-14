<div>
    <div class="container-fluid page-body-wrapper">
        <livewire:inc.side-nav/>

        <!-- partial -->
        <div class="main-panel my_top_margin">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Generate Reports </h3>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">New Report</h4>
                                <form wire:submit.prevent="generateReport" role="form">
                                    @include('inc.alert')
                                    <div class="form-group">
                                        <label for="type_of_report">Select Report Type</label>
                                        <select name="type_of_report" id="type_of_report"
                                                class="form-control @error('type_of_report') is-invalid @enderror"
                                                required
                                                wire:model="type_of_report">
                                            <option selected disabled>-- Select Report Type --</option>
                                            <option value="performance_objectives">Performance Objectives</option>
                                            <option value="personal_development">Personal Development</option>
                                        </select>
                                        @error('type_of_report')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Select Department</label>
                                        <select name="department" id="department"
                                                class="form-control @error('department') is-invalid @enderror"
                                                required
                                                wire:model="department">
                                            <option value="department">-- Select --</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="from_date">From Date</label>
                                        <input type="date"
                                               class="form-control @error('from_date') is-invalid @enderror"
                                               name="from_date"
                                               id="from_date" wire:model="from_date">
                                        @error('from_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="to_date">To Date</label>
                                        <input type="date"
                                               class="form-control @error('to_date') is-invalid @enderror"
                                               name="to_date"
                                               id="to_date" wire:model="to_date">
                                        @error('to_date')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-gradient-primary mr-2 float-right"
                                            wire:loading.class="disabled" wire:offline.attr="disabled">
                                       <span wire:target="generateReport"
                                             wire:loading.class="spinner-border spinner-border-sm"></span> Generate
                                        Report
                                    </button>
                                </form>
                            </div>

                            <div class="row">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div wire:poll.keep-alive>
                                            <div wire:init="loadReport">
                                                @if(isset($report))
                                                    <table class="display table table-striped table-bordered"
                                                           id="zero_configuration_table"
                                                           style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Report Name</th>
                                                            <th>From Date</th>
                                                            <th>To Date</th>
                                                            <th>Action</th>
                                                            <th>Updated</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php($count = 1)
                                                        <tr>
                                                            <td>{{ $count++ }}</td>
                                                            <td>{{ $report->path_name }}</td>
                                                            <td>{{ date('F d, Y h:i a', strtotime($report->from_date)) }}</td>
                                                            <td>{{ date('F d, Y h:i a', strtotime($report->to_date)) }}</td>
                                                            <td>
                                                                @if($report->is_ready)
                                                                    <a href="{{ asset('storage/' . $report->path_name) }}"
                                                                       class="btn btn-sm btn-outline-primary"><b><span
                                                                                class="mdi mdi-download"></span></b></a>
                                                                @else
                                                                    <button class="btn btn-sm btn-outline-danger"
                                                                            wire:offline.attr="disabled"
                                                                            wire:loading.attr="disabled"><span
                                                                            wire:loading.class="spinner-border spinner-border-sm"></span>
                                                                        Generating...
                                                                    </button>
                                                                @endif
                                                            </td>
                                                            <td>{{ \App\Http\Controllers\SystemController::elapsedTime($report->updated_at) }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                @else
                                                    <hr>
                                                    <p class="text-center text-danger text-uppercase"><strong>Generate
                                                            a
                                                            report to get the download
                                                            view</strong></p>
                                                    <hr>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
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
