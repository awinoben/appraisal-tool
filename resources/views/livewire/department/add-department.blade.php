<div>
    <div class="container-fluid page-body-wrapper">
        <livewire:inc.side-nav/>

        <!-- partial -->
        <div class="main-panel my_top_margin">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Add Department </h3>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">New Department</h4>
                                <form class="forms-sample" wire:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="hod_email">HOD Email</label>
                                        <input type="email"
                                               class="form-control @error('hod_email') is-invalid @enderror"
                                               id="hod_email"
                                               placeholder="New hod email" wire:model="hod_email"
                                               name="hod_email">
                                        @error('hod_email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name"
                                               placeholder="New department name" wire:model="name" name="name">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="supervisor_email">Supervisor Email</label>
                                        <input type="email"
                                               class="form-control @error('supervisor_email') is-invalid @enderror"
                                               id="supervisor_email"
                                               placeholder="New supervisor email" wire:model="supervisor_email"
                                               name="supervisor_email">
                                        @error('supervisor_email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-gradient-primary mr-2 float-right"
                                            wire:loading.class="disabled" wire:offline.attr="disabled">
                                       <span
                                           wire:loading.class="spinner-border spinner-border-sm"></span> Save
                                    </button>
                                </form>
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
