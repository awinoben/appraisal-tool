<div>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Assign Users To Project</h2>
            <p class="lead">Kindly provide a .csv with this <a href="{{ asset('assign-project-upload-template.csv') }}"
                                                               class="text-primary">upload-template</a> format
                for upload.</p>
        </div>

        <div class="row">
            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">Upload User Catalogue</h4>
                <form wire:submit.prevent="upload" type="multipart">
                    @include('inc.alert')
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="project_id">Select Project</label>
                            <select class="form-control @error('project_id') is-invalid @enderror"
                                    id="project_id" name="project_id" wire:model="project_id">
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->name }}
                                        ({{ number_format(count($project->assigned_project)) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('project_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong class="text-red-600">Select a Project</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="project_id">Select File</label>
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
