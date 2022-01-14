<?php

use App\Http\Controllers\API\AppraisalController;
use App\Http\Controllers\API\AssignedProjectController;
use App\Http\Controllers\API\Auth\AuthorizeController;
use App\Http\Controllers\API\Auth\RefreshAccessToken;
use App\Http\Controllers\API\BehavioralController;
use App\Http\Controllers\API\BranchController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\EscalateController;
use App\Http\Controllers\API\KPIController;
use App\Http\Controllers\API\KRAController;
use App\Http\Controllers\API\LeaderShipController;
use App\Http\Controllers\API\LogoutController;
use App\Http\Controllers\API\PersonalDevelopmentController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\ReportController;
use App\Http\Controllers\API\ResultController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\SummaryController;
use App\Http\Controllers\API\UserController;
use App\Jobs\MailJob;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'v1',
], function () {
    // open routes
    Route::post('token', AuthorizeController::class);

    // protected routes
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('refresh-token', RefreshAccessToken::class); // refresh the access token here
        Route::get('user', [UserController::class, 'user']); // respond back with the authenticated user
        Route::post('reset-password', [UserController::class, 'resetPassword']);
        Route::get('summary', SummaryController::class); // dashboard summary
        Route::get('logout', LogoutController::class); // logout user and kill the token

        // loads all the api resources
        Route::apiResources([
            'branches' => BranchController::class,
            'roles' => RoleController::class,
            'users' => UserController::class,
            'kras' => KRAController::class,
            'kpis' => KPIController::class,
            'projects' => ProjectController::class,
            'assigned-projects' => AssignedProjectController::class,
            'personal-development' => PersonalDevelopmentController::class,
            'behavioral-section' => BehavioralController::class,
            'leadership-section' => LeaderShipController::class,
            'results' => ResultController::class,
            'escalations' => EscalateController::class,
            'reports' => ReportController::class,
            'countries' => CountryController::class
        ]);

        // process the appraisal
        Route::group([
            'prefix' => '/'
        ], function () {
            Route::get('appraisal', [AppraisalController::class, 'initiate_section_A']);
            Route::post('appraisal', [AppraisalController::class, 'perform_rating']);
            Route::get('kra', [AppraisalController::class, 'get_kras_ratings']);
            Route::get('personal', [AppraisalController::class, 'initiate_section_B']);
            Route::post('personal', [AppraisalController::class, 'perform_personal']);
            Route::get('pers', [AppraisalController::class, 'get_pers_devs']);
            Route::get('behavioral', [AppraisalController::class, 'initiate_section_C']);
            Route::post('behavioral', [AppraisalController::class, 'perform_behavioral']);
            Route::get('behaviorals', [AppraisalController::class, 'get_behavioral']);
            Route::get('leadership', [AppraisalController::class, 'initiate_section_D']);
            Route::post('leadership', [AppraisalController::class, 'perform_leader_ship']);
            Route::get('leaderships', [AppraisalController::class, 'get_leader_ships']);
        });
    });
});


Route::get('sys/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

