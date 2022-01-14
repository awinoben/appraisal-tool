<div>
    <div class="container-fluid page-body-wrapper">
        <livewire:inc.side-nav/>

        <!-- partial -->
        <div class="main-panel my_top_margin">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Change User Email </h3>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Email Address</h4>
                                <form class="forms-sample" wire:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="old_email">Old Email Address</label>
                                        <input type="email"
                                               class="form-control @error('old_email') is-invalid @enderror"
                                               id="old_email"
                                               placeholder="Enter old email address" wire:model="old_email"
                                               name="old_email">
                                        @error('old_email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="new_email">New Email Address</label>
                                        <input type="email"
                                               class="form-control @error('new_email') is-invalid @enderror"
                                               id="new_email"
                                               placeholder="Enter new email address" wire:model="new_email"
                                               name="new_email">
                                        @error('new_email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-gradient-primary mr-2 float-right"
                                            wire:loading.class="disabled" wire:offline.attr="disabled">
                                       <span
                                           wire:target="submit"
                                           wire:loading.class="spinner-border spinner-border-sm"></span> Change Email
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
