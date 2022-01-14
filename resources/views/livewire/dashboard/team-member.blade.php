<div>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Assign Users To Team</h2>
            <p class="lead">Kindly provide a .csv with this <a href="{{ asset('team-member.csv') }}"
                                                               class="text-primary">upload-template</a> format
                for upload.</p>
        </div>

        <div class="row">
            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">Upload Team Catalogue</h4>
                <form wire:submit.prevent="upload" type="multipart">
                    @include('inc.alert')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="user_id">Select Team User</label>
                            <select class="form-control @error('user_id') is-invalid @enderror"
                                    id="user_id" name="user_id" wire:model="user_id">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}
                                        ({{  $user->team ? number_format(count($user->team->team_user)) : 0 }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong class="text-red-600">Select a Team User</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="user_id">Select File</label>
                            <input type="file" class="form-control @error('catalogue') is-invalid @enderror"
                                   id="catalogue" name="catalogue" wire:model="catalogue">
                            @error('catalogue')
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
                        Upload
                    </button>
                </form>
            </div>
        </div>
    </div>
