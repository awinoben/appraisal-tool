<div>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Email Update</h2>
        </div>

        <div class="row">
            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">User Email Update</h4>
                <form wire:submit.prevent="changeEmail">
                    @include('inc.alert')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="old_email">User Old Email</label>
                            <input type="email" class="form-control @error('old_email') is-invalid @enderror"
                                   id="old_email" name="old_email" wire:model="old_email" required>
                            @error('old_email')
                            <span class="invalid-feedback" role="alert">
                                        <strong class="text-red-600">{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="new_email">User New Email</label>
                            <input type="email" class="form-control @error('new_email') is-invalid @enderror"
                                   id="new_email" name="new_email" wire:model="new_email" required>
                            @error('new_email')
                            <span class="invalid-feedback" role="alert">
                                        <strong class="text-red-600">{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div wire:loading>
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <button wire:loading.class="disabled" class="btn btn-primary btn-lg btn-block" type="submit">
                        Reset Password
                    </button>
                </form>
            </div>
        </div>
    </div>
