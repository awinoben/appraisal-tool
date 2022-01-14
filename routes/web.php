<?php

use App\Http\Livewire\Branch\AddBranch;
use App\Http\Livewire\Branch\UploadBranches;
use App\Http\Livewire\Branch\ViewBranch;
use App\Http\Livewire\Department\AddDepartment;
use App\Http\Livewire\Department\AssignUsersDepartment;
use App\Http\Livewire\Department\DepartmentHeads;
use App\Http\Livewire\Department\UploadDepartments;
use App\Http\Livewire\Forgot;
use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\Progress\AppraisedUsers;
use App\Http\Livewire\Progress\CompletedAppraisals;
use App\Http\Livewire\Progress\InCompletedAppraisals;
use App\Http\Livewire\Report\GenerateReport;
use App\Http\Livewire\Team\TeamList;
use App\Http\Livewire\Team\UploadTeam;
use App\Http\Livewire\User\ChangeUserEmail;
use App\Http\Livewire\User\ListUsers;
use App\Http\Livewire\User\ResetUserPassword;
use App\Http\Livewire\User\UsersUpload;
use App\Jobs\AppraisalJob;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('send-emails', function () {
//    dispatch(new MailJob(
//        'vincent@shiftech.co.ke',
//        'Announcement - Performance Development Plan',
//        'Vincent',
//        "We are excited to announce that we’re rolling out our performance development planning process. This is part of our ongoing effort to support employee development and is also an opportunity for self-reflection, feedback, and getting aligned with your manager on next steps and expectations for the coming year. Shortly, you will receive an email with the login link and credentials.",
//    ))->onQueue('emails')->delay(0.5);
//
//    // dispatch an email here
//    dispatch(new MailJob(
//        'vincent@shiftech.co.ke',
//        'Java House PDP Account & Tutorial',
//        'Vincent',
//        "Your account username is virginia.wanjiku@javahouseafrica.com, Your account password is 6676 .Kindly use it to log in by clicking on the link below.",
//        env('FRONTEND_URL'),
//        '<<< LOGIN >>>',
//        "Click on the link below for a tutorial on how to fill in your appraisal - https://stonly.com/guide/en/self-evaluation-LNVE0e1CAu/Steps/697676"
//    ))->onQueue('emails')->delay(0.5);
//
//    dispatch(new MailJob(
//        'alfred.mugo@javahouseafrica.com',
//        'Announcement - Performance Development Plan',
//        'Alfred',
//        "We are excited to announce that we’re rolling out our performance development planning process. This is part of our ongoing effort to support employee development and is also an opportunity for self-reflection, feedback, and getting aligned with your manager on next steps and expectations for the coming year. Shortly, you will receive an email with the login link and credentials.",
//    ))->onQueue('emails')->delay(0.5);
//
//    // dispatch an email here
//    dispatch(new MailJob(
//        'alfred.mugo@javahouseafrica.com',
//        'Java House PDP Account & Tutorial',
//        'Alfred',
//        "Your account username is virginia.wanjiku@javahouseafrica.com, Your account password is 6676 .Kindly use it to log in by clicking on the link below.",
//        env('FRONTEND_URL'),
//        '<<< LOGIN >>>',
//        "Click on the link below for a tutorial on how to fill in your appraisal - https://stonly.com/guide/en/self-evaluation-LNVE0e1CAu/Steps/697676"
//    ))->onQueue('emails')->delay(0.5);
//    dispatch(new MailJob(
//        'virginia.wanjiku@javahouseafrica.com',
//        'Java House PDP Account & Tutorial',
//        'Virginia Wanjiku',
//        "Your account username is virginia.wanjiku@javahouseafrica.com, Your account password is 6676 .Kindly use it to log in by clicking on the link below.",
//        env('FRONTEND_URL'),
//        '<<< LOGIN >>>',
//        "Click on the link below for a tutorial on how to fill in your appraisal - https://stonly.com/guide/en/self-evaluation-LNVE0e1CAu/Steps/697676"
//    ))->onQueue('emails')->delay(0.5);
//    dispatch(new AppraisalJob())->onQueue('default')->delay(0.1);
});

Route::get('/', Login::class)->name('login');
Route::get('forgot', Forgot::class)->name('forgot');

Route::group([
    'middleware' => ['auth', 'level']
], function () {
    Route::get('home', Home::class)->name('home');

    Route::group([
        'prefix' => 'users'
    ], function () {
        Route::get('upload', UsersUpload::class)->name('upload.users');
        Route::get('list', ListUsers::class)->name('list.users');
        Route::get('reset', ResetUserPassword::class)->name('reset.password');
        Route::get('email', ChangeUserEmail::class)->name('change.email');
    });

    Route::group([
        'prefix' => 'branches'
    ], function () {
        Route::get('add', AddBranch::class)->name('add.branch');
        Route::get('upload', UploadBranches::class)->name('upload.branch');
        Route::get('list', ViewBranch::class)->name('list.branches');
    });

    Route::group([
        'prefix' => 'departments'
    ], function () {
        Route::get('add', AddDepartment::class)->name('add.department');
        Route::get('upload', UploadDepartments::class)->name('upload.department');
        Route::get('assign', AssignUsersDepartment::class)->name('assign.departments');
        Route::get('team', DepartmentHeads::class)->name('department.head');
    });

    Route::group([
        'prefix' => 'progress'
    ], function () {
        Route::get('appraised', AppraisedUsers::class)->name('appraised.users');
        Route::get('complete', CompletedAppraisals::class)->name('complete.appraisal');
        Route::get('in-complete', InCompletedAppraisals::class)->name('in.complete.appraisal');
    });

    Route::group([
        'prefix' => 'teams'
    ], function () {
        Route::get('/', UploadTeam::class)->name('upload.teams');
        Route::get('list', TeamList::class)->name('list.teams');
    });

    Route::group([
        'prefix' => 'reports'
    ], function () {
        Route::get('/', GenerateReport::class)->name('generate.reports');
    });
});
