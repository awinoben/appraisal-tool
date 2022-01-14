<div>
    <div class="container">
        <div wire:loading>
            <div class="d-flex align-items-center text-primary text-center">
                <div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
            </div>
        </div>
        <div class="py-5 text-center">
            <hr>
            <h2>Users With Complete Appraisal</h2>
            <hr>
            <div class="form-group">
                <input class="form-control" wire:model="search" type="text" placeholder="Search...">
            </div>
        </div>
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <div wire:init="loadUsers">
                            @if(count($users))
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Project</th>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Employee Number</th>
                                        <th scope="col">Email Address</th>
{{--                                        <th scope="col">Report</th>--}}
                                        <th scope="col">Created On</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($count = 1)
                                    @php($user_ids = [])
                                    @foreach($users as $user)
                                        @if(!in_array($user->user->id,$user_ids))
                                            @php($user_ids[] = $user->user->id)
                                            <tr>
                                                <th scope="row">{{ $count++ }}</th>
                                                <td>{{ $user->user->country->name }}</td>
                                                <td>
                                                    @if(count($user->user->assigned_project))
                                                        {{ $user->user->assigned_project()->first()->project->name }}
                                                    @else
                                                        No assigned project
                                                    @endif
                                                </td>
                                                <td>{{ $user->user->name }}</td>
                                                <td>{{ $user->user->role->name }}</td>
                                                <td>{{ $user->user->employee_number }}</td>
                                                <td>{{ $user->user->email }}</td>
{{--                                                <td>--}}
{{--                                                    @if(\Illuminate\Support\Facades\File::exists(storage_path('app/public/'.\Illuminate\Support\Str::slug($user->employee_number.'_'.$user->name.'.xlsx'))))--}}
{{--                                                        <a href="{{ asset('storage/'.\Illuminate\Support\Str::slug($user->employee_number.'_'.$user->name.'.xlsx')) }}"--}}
{{--                                                           class="btn btn-lg btn-outline-primary">Download Report</a>--}}
{{--                                                    @else--}}
{{--                                                        <a href="#" class="btn btn-lg btn-outline-danger disabled">No--}}
{{--                                                            Report</a>--}}
{{--                                                    @endif--}}
{{--                                                </td>--}}
                                                <td>{{ date('F d, Y h:i a', strtotime($user->user->updated_at)) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                <center>
                                    <hr>
                                    <h2 class="text-center">No User(s) Have Completed Appraisal</h2>
                                    <hr>
                                </center>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
