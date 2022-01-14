<div>
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <livewire:inc.side-nav/>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper" wire:poll.keep-alive>
                <div class="page-header my_top_margin">
                    <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="{{ route('generate.reports') }}"
                                   class="btn btn-primary btn-lg pull-right"><span
                                        class="mdi mdi-download-outline"></span></a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="row" wire:init="loadData">
                    <div class="col-md-3 stretch-card grid-margin">
                        <div class="card bg-gradient-primary card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">Total Employees <i
                                        class="mdi mdi-account-switch mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">{{ $data['users'] ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">Total Appraised <i
                                        class="mdi mdi-book-open-outline mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">{{ $data['appraised'] ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 stretch-card grid-margin">
                        <div class="card bg-gradient-success card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3"> Self Appraisals <i
                                        class="mdi mdi-account-clock-outline mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">{{ $data['self'] ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 stretch-card grid-margin">
                        <div class="card bg-gradient-danger card-img-holder text-white">
                            <div class="card-body">
                                <img src="{{ asset('assets/images/dashboard/circle.svg') }}" class="card-img-absolute"
                                     alt="circle-image"/>
                                <h4 class="font-weight-normal mb-3">Pending Appraisals <i
                                        class="mdi mdi-lock-clock mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">{{ $data['pending'] ?? 0 }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card" wire:ignore>
                        <div class="card">
                            <div class="card-body">
                                <div class="clearfix">
                                    <h4 class="card-title float-left">Appraisal Statistics</h4>
                                    <div id="visit-sale-chart-legend"
                                         class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                                </div>
                                <div id="chart" style="height: 500px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <livewire:inc.footer/>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>

    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('home_chart')",
            loader: {
                color: '#3c1505',
                size: [30, 30],
                type: 'bar',
                textColor: '#000000',
                text: 'Loading some chart data...',
            },
            hooks: new ChartisanHooks()
                .legend()
                .colors(['#DA1A32', '#3C1605', '#00B482', '#004C6C'])
                .datasets(['bar', 'bar'])
                .tooltip(),
        });
    </script>
</div>
