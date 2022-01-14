<div>
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-profile">
                <a href="#" class="nav-link">
                    <div class="nav-profile-image">
                        <img src="{{ \App\Http\Controllers\SystemController::generateAvatars($user->name,400) }}"
                             alt="profile">
                        <span class="login-status online"></span>
                        <!--change to offline or busy as needed-->
                    </div>
                    <div class="nav-profile-text d-flex flex-column">
                        <span class="font-weight-bold mb-2">{{ $user->name }}</span>
                        <span class="text-secondary text-small">{{ $user->role->name }}</span>
                    </div>
                    <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <span class="menu-title">Dashboard</span>
                    <i class="mdi mdi-home menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                   aria-controls="ui-basic">
                    <span class="menu-title">Branches</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('add.branch') }}">Add</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('upload.branch') }}">Upload</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('list.branches') }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic-3" aria-expanded="false"
                   aria-controls="ui-basic-3">
                    <span class="menu-title">Employees</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic-3">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('upload.users') }}">Add</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('list.users') }}">List</a>
                        <li class="nav-item"><a class="nav-link" href="{{ route('change.email') }}">Change Email</a>
                        <li class="nav-item"><a class="nav-link" href="{{ route('reset.password') }}">Reset Password</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic-2" aria-expanded="false"
                   aria-controls="ui-basic-2">
                    <span class="menu-title">Departments</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic-2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('add.department') }}">Add</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('upload.department') }}">Upload</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('assign.departments') }}">Assign
                                Employees</a>
                        <li class="nav-item"><a class="nav-link" href="{{ route('department.head') }}">List</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic-team" aria-expanded="false"
                   aria-controls="ui-basic-team">
                    <span class="menu-title">Teams</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic-team">
                    <ul class="nav flex-column sub-menu">
                        {{--                        <li class="nav-item"><a class="nav-link" href="{{ route('upload.teams') }}">Upload</a></li>--}}
                        <li class="nav-item"><a class="nav-link" href="{{ route('list.teams') }}">List</a></li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic-4" aria-expanded="false"
                   aria-controls="ui-basic-4">
                    <span class="menu-title">Progress</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic-4">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('appraised.users') }}">Appraised</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('complete.appraisal') }}">Self
                                Appraisals</a>
                        <li class="nav-item"><a class="nav-link" href="{{ route('in.complete.appraisal') }}">Pending
                                Appraisals</a>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic-8" aria-expanded="false"
                   aria-controls="ui-basic-8">
                    <span class="menu-title">Reports</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic-8">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('generate.reports') }}">Generate</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item sidebar-actions">
              <span class="nav-link">
                <div class="mt-4">
                  <div class="border-bottom">
                    <p class="text-secondary">SYS</p>
                  </div>
                  <ul class="gradient-bullet-list mt-4">
                    <li><a href="#" wire:click="logout">Signout</a></li>
                  </ul>
                </div>
              </span>
            </li>
        </ul>
    </nav>
</div>
