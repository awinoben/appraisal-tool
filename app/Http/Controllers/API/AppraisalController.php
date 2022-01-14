<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BehavioralRequest;
use App\Http\Requests\LeaderShipRequest;
use App\Http\Requests\PersonalDevelopmentRequest;
use App\Http\Requests\RatingRequest;
use App\Jobs\MailJob;
use App\Models\Behavioral;
use App\Models\LeaderShip;
use App\Models\PersonalDevelopment;
use App\Models\Report;
use App\Models\Result;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AppraisalController extends Controller
{
    /**
     * create the report/rating
     * for user to fill through
     * @return JsonResponse
     */
    public function initiate_section_A(): JsonResponse
    {
        // fetch the authenticated user
        $user = request()->user()->load(
            'role.key_performance_indicator',
            'assigned_project'
        );

        // check if user is assigned any project
        if (!count($user->assigned_project()->get()))
            return $this->errorResponse(
                'You have not been assigned any project.',
                Response::HTTP_NOT_ACCEPTABLE
            );

        // check if the authenticated user has any kpi's
        if (!count($user->role->key_performance_indicator()->get()))
            return $this->errorResponse(
                'No KPI\'s have been defined for your role yet.',
                Response::HTTP_NOT_ACCEPTABLE
            );

        // get project id
        $project_id = $user->assigned_project()->first()->project_id;

        // create a result table
        $result = Result::query()->updateOrCreate([
            'user_id' => $user->id,
            'project_id' => $project_id
        ]);

        // create the report here
        foreach ($user->role->key_performance_indicator as $kpi) {
            Report::query()->updateOrCreate([
                'user_id' => $user->id,
                'result_id' => $result->id,
                'project_id' => $project_id,
                'key_result_area_id' => $kpi->key_result_area_id
            ]);
        }

        return $this->successResponse([
            'message' => 'The appraisal technical/functional form has been initiated.'
        ]);
    }

    /**
     * fetch report depending with kras
     * @return JsonResponse
     */
    public function get_kras_ratings(): JsonResponse
    {
        // do a refresh here
        $user = request()->user()->load('report');

        return $this->successResponse(
            $user->report()
                ->with([
                    'key_result_area.key_performance_indicator',
                ])
                ->get()
        );
    }

    /**
     * do the rating here
     * @param RatingRequest $request
     * @return JsonResponse
     */
    public function perform_rating(RatingRequest $request): JsonResponse
    {
        // define the rating sum
        $rating_sum = $count = 0;
        $report = null;

        // Here loop all the data that comes
        foreach ($request->ratings as $rating) {
            $report = Report::query()
                ->with(['user', 'project.user', 'result'])
                ->where('id', $rating['id'])
                ->where('is_accepted', false)
                ->first();

            if ($report) {
                $report->update([
                    'self_rating' => $rating['self_rating'],
                    'self_remarks' => $rating['self_remarks'],
                    'appraiser_rating' => $rating['appraiser_rating'],
                    'appraiser_remarks' => $rating['appraiser_remarks'],
                    'overall_rating' => $rating['appraiser_rating'],
                    'is_rated' => false,
                    'is_accepted' => false,
                    'is_rejected' => false
                ]);

                // increment the rating sum
                $rating_sum += $rating['appraiser_rating'];
                $count++;
            }
        }

        if ($report) {
            // Update or create the result for this rating here
            $report->result
                ->where('is_accepted', false)
                ->update([
                    'overall_rating' => 0,
                    'rating' => 0,
                    'narrative' => 'Appraised'
                ]);

            // refresh the model
            $report->refresh();
        }

        return $this->successResponse([
            'message' => 'The appraisal technical/functional form has been filled successfully.'
        ]);
    }

    /**
     * create an instance of the personal development
     * @return JsonResponse
     * @throws Exception
     */
    public function initiate_section_B(): JsonResponse
    {
        // fetch the authenticated user
        $user = request()->user()->load(
            'assigned_project'
        );

        // check if user is assigned any project
        if (!count($user->assigned_project()->get()))
            return $this->errorResponse(
                'You have not been assigned any project.',
                Response::HTTP_NOT_ACCEPTABLE
            );

        // get project id
        $project_id = $user->assigned_project()->first()->project_id;

        foreach (config('appraisal.personal') as $personal) {
            // create the personal development
            PersonalDevelopment::query()->updateOrCreate([
                'project_id' => $project_id,
                'user_id' => $user->id,
                'type' => $personal
            ]);
        }

        return $this->successResponse([
            'message' => 'The appraisal personal development form has been initiated.'
        ]);
    }

    /**
     * Here pass the personal data information to the
     * ui
     * @return JsonResponse
     */
    public function get_pers_devs(): JsonResponse
    {
        // do a refresh here
        $user = request()->user()->load('personal_development.project');

        return $this->successResponse(
            $user->personal_development
        );
    }

    /**
     * do the rating here
     * @param PersonalDevelopmentRequest $request
     * @return JsonResponse
     */
    public function perform_personal(PersonalDevelopmentRequest $request): JsonResponse
    {
        $personal = null;

        // loop through the personal data
        foreach ($request->personal as $data) {
            $personal = PersonalDevelopment::query()
                ->with(['user.team_user.team.user', 'project.user'])
                ->where('is_rated', false)
                ->where('id', $data['id'])
                ->first();

            if ($personal) {
                $personal->update([
                    'personal_development' => $data['personal_development'],
                    'what_to_do' => $data['what_to_do'],
                    'achievement' => $data['achievement'],
                    'actions' => $data['actions'],
                    'manager_comments' => $data['manager_comments'],
                    'on_track' => $data['on_track'],
                    'is_rated' => false,
                    'is_accepted' => false,
                    'is_rejected' => false
                ]);

                if (!is_null($data['personal_development'])) {
                    // update user here
                    $user = $request->user();
                    $user->update([
                        'is_self_evaluated' => true
                    ]);
                }
            }
        }

        if ($personal) {
            // schedule an emil here for user
            dispatch(new MailJob(
                $personal->user->email,
                'Personal Development Plan Status',
                $personal->user->name,
                'You have successfully completed the personal development plan. Your supervisor will review it.',
                env('FRONTEND_URL'),
                '<<< CHECK STATUS >>>'
            ))->onQueue('emails')->delay(2);

            // schedule an emil here for supervisor
            dispatch(new MailJob(
                $personal->user->team_user->team->user->email,
                'Personal Development Plan Status',
                $personal->user->team_user->team->user->name,
                $personal->user->name . ' has just completed the personal development plan. Kindly review',
                env('FRONTEND_URL'),
                '<<< REVIEW >>>'
            ))->onQueue('emails')->delay(2);
        }

        return $this->successResponse([
            'message' => 'The appraisal personal development form has been filled.'
        ]);
    }

    /**
     * create an instance of the behavioral
     * @return JsonResponse
     * @throws Exception
     */
    public function initiate_section_C(): JsonResponse
    {
        // fetch the authenticated user
        $user = request()->user()->load(
            'assigned_project'
        );

        // check if user is assigned any project
        if (!count($user->assigned_project()->get()))
            return $this->errorResponse(
                'You have not been assigned any project.',
                Response::HTTP_NOT_ACCEPTABLE
            );

        // get project id
        $project_id = $user->assigned_project()->first()->project_id;

        foreach (config('appraisal.behavioral') as $behavioral) {
            // create the personal behavioral
            Behavioral::query()->updateOrCreate([
                'project_id' => $project_id,
                'user_id' => $user->id,
                'type' => $behavioral,
            ]);
        }

        return $this->successResponse([
            'message' => 'The appraisal behavioral form has been initiated.'
        ]);
    }

    /**
     * Here pass the behavioral data information to the
     * ui
     * @return JsonResponse
     */
    public function get_behavioral(): JsonResponse
    {
        // do a refresh here
        $user = request()->user()->fresh();

        // fetch the authenticated user
        $user->load(
            'behavioral.project'
        );

        return $this->successResponse(
            $user->behavioral
        );
    }

    /**
     * do the rating here
     * @param BehavioralRequest $request
     * @return JsonResponse
     */
    public function perform_behavioral(BehavioralRequest $request): JsonResponse
    {
        $behavioral = null;

        // loop through the behavioral data
        foreach ($request->behavioral as $data) {
            $behavioral = Behavioral::query()
                ->with(['user', 'project.user'])
                ->where('is_rated', false)
                ->where('id', $data['id'])
                ->first();

            if ($behavioral)
                $behavioral->update([
                    'employee_ratings' => $data['employee_ratings'],
                    'employee_comments' => $data['employee_comments'],
                    'supervisor_ratings' => $data['supervisor_ratings'],
                    'supervisor_comments' => $data['supervisor_comments'],
                    'is_rated' => false,
                    'is_accepted' => false,
                    'is_rejected' => false
                ]);
        }

        if ($behavioral) {
            // schedule an emil here for user
            dispatch(new MailJob(
                $behavioral->user->email,
                'Behavioral Appraisal',
                $behavioral->user->name,
                'You have successfully completed the behavioral appraisal.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);

            // schedule an emil here for supervisor
            dispatch(new MailJob(
                $behavioral->project->user->email,
                'Behavioral Appraisal',
                $behavioral->project->user->email,
                $behavioral->user->name . ' has just completed the behavioral appraisal.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);

            // schedule an emil here for supervisor
            dispatch(new MailJob(
                $behavioral->project->user->email,
                'Behavioral Appraisal',
                $behavioral->project->user->email,
                'This is a reminder to you to complete your Supervisor-Appraisal exercise through the appraisal tool. You are required to meet your reportees for a one-to-one appraisal meeting. For the process to be successful, not only are you required to give ratings but also write comments on the same. Kindly take a note of end date for completion of Supervisor-Appraisal is Wednesday, 13th January, 2021.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);
        }

        return $this->successResponse([
            'message' => 'The appraisal behavioral form has been filled.'
        ]);
    }

    /**
     * create an instance of the leader_ship
     * @return JsonResponse
     * @throws Exception
     */
    public function initiate_section_D(): JsonResponse
    {
        // fetch the authenticated user
        $user = request()->user()->load(
            'assigned_project'
        );

        // check if user is assigned any project
        if (!count($user->assigned_project()->get()))
            return $this->errorResponse(
                'You have not been assigned any project.',
                Response::HTTP_NOT_ACCEPTABLE
            );

        // get project id
        $project_id = $user->assigned_project()->first()->project_id;

        foreach (config('appraisal.leader_ships') as $leader_ship) {
            // create the personal development
            LeaderShip::query()->updateOrCreate([
                'project_id' => $project_id,
                'user_id' => $user->id,
                'type' => $leader_ship,
            ]);
        }

        return $this->successResponse([
            'message' => 'The appraisal leadership form has been initiated.'
        ]);
    }

    /**
     * Here pass the leader_ship data information to the
     * ui
     * @return JsonResponse
     */
    public function get_leader_ships(): JsonResponse
    {
        // do a refresh here
        $user = request()->user()->fresh();

        // fetch the authenticated user
        $user->load(
            'leader_ship.project'
        );

        return $this->successResponse(
            $user->leader_ship
        );
    }

    /**
     * do the rating here
     * @param LeaderShipRequest $request
     * @return JsonResponse
     */
    public function perform_leader_ship(LeaderShipRequest $request): JsonResponse
    {
        $leader_ship = null;

        // loop through the behavioral data
        foreach ($request->leader_ship as $data) {
            $leader_ship = LeaderShip::query()
                ->with(['user', 'project.user'])
                ->where('is_rated', false)
                ->where('id', $data['id'])
                ->first();

            if ($leader_ship)
                $leader_ship->update([
                    'employee_ratings' => $data['employee_ratings'],
                    'employee_comments' => $data['employee_comments'],
                    'supervisor_ratings' => $data['supervisor_ratings'],
                    'supervisor_comments' => $data['supervisor_comments'],
                    'is_rated' => false,
                    'is_accepted' => false,
                    'is_rejected' => false
                ]);
        }

        if ($leader_ship) {
            // schedule an emil here for user
            dispatch(new MailJob(
                $leader_ship->user->email,
                'Behavioral Appraisal',
                $leader_ship->user->name,
                'You have successfully completed the leadership appraisal.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);

            // schedule an emil here for supervisor
            dispatch(new MailJob(
                $leader_ship->project->user->email,
                'Behavioral Appraisal',
                $leader_ship->project->user->email,
                $leader_ship->user->name . ' has just completed the leadership appraisal.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);

            // schedule an emil here for supervisor
            dispatch(new MailJob(
                $leader_ship->project->user->email,
                'Behavioral Appraisal',
                $leader_ship->project->user->email,
                'This is a reminder to you to complete your Supervisor-Appraisal exercise through the appraisal tool. You are required to meet your reportees for a one-to-one appraisal meeting. For the process to be successful, not only are you required to give ratings but also write comments on the same. Kindly take a note of end date for completion of Supervisor-Appraisal is Wednesday, 13th January, 2021.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);
        }

        return $this->successResponse([
            'message' => 'The appraisal leadership form has been filled.'
        ]);
    }
}
