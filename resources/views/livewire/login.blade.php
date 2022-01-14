<div>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="{{ asset('img/logo.png') }}">
                        </div>
                        <h4>Hello! let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <form class="pt-3" wire:submit.prevent="loginUser">
                            @include('inc.alert')
                            <div class="form-group">
                                <input type="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       name="email" placeholder="E-mail Address"
                                       id="email" wire:model="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       placeholder="XXXXXXXX"
                                       name="password" id="password" wire:model="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input" wire:model="remember"> Remember me </label>
                                </div>
                                {{--                                <a href="#" class="auth-link text-black">Forgot password?</a>--}}
                            </div>
                            <div class="mt-3">
                                <button
                                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                    wire:loading.class="disabled" wire:offline.attr="disabled"><span
                                        wire:target="loginUser"
                                        wire:loading.class="spinner-border spinner-border-sm"></span> SIGN IN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
</div>
