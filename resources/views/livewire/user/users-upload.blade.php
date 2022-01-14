<div>
    <div class="container-fluid page-body-wrapper">
        <livewire:inc.side-nav/>

        <!-- partial -->
        <div class="main-panel my_top_margin">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title"> Add Employees </h3>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">New Employees</h4>
                                <form class="forms-sample" wire:submit.prevent="submit">
                                    <div class="form-group">
                                        <label for="country_id">Select Country</label>
                                        <select name="country_id" id="country_id"
                                                class="form-control @error('country_id') is-invalid @enderror"
                                                required
                                                wire:model="country_id">
                                            <option value="country_id">-- Select --</option>
                                            @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="catalogue">Upload Employee Catalogue <i
                                                class="text-info">
                                                <a href="{{ asset('docs/users.csv') }}">Check out upload
                                                    template</a>
                                            </i></label>
                                        <input type="file"
                                               accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                               class="form-control @error('catalogue') is-invalid @enderror"
                                               required
                                               name="catalogue"
                                               id="catalogue" wire:model="catalogue">
                                        @error('catalogue')
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
