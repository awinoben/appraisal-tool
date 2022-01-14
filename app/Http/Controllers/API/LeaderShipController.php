<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaderShipRequest;
use App\Jobs\MailJob;
use App\Models\LeaderShip;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeaderShipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            LeaderShip::query()
                ->with([
                    'user',
                    'project.user'
                ])
                ->latest()
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LeaderShipRequest $request
     * @return JsonResponse
     */
    public function store(LeaderShipRequest $request): JsonResponse
    {
        $leader_ship = null;

        // loop through the behavioral data
        foreach ($request->leader_ship as $data) {
            $leader_ship = LeaderShip::query()
                ->with(['user', 'project.user'])
                ->where('id', $data['id'])
                ->first();

            if ($leader_ship)
                $leader_ship->update([
                    'employee_ratings' => $data['employee_ratings'],
                    'employee_comments' => $data['employee_comments'],
                    'supervisor_ratings' => $data['supervisor_ratings'],
                    'supervisor_comments' => $data['supervisor_comments'],
                    'is_rated' => true
                ]);

            // update the user
            $leader_ship->user->update([
                'is_evaluated' => true
            ]);
        }

        if ($leader_ship) {
            // schedule an email here for user
            dispatch(new MailJob(
                $leader_ship->user->email,
                'LeaderShip Appraisal',
                $leader_ship->user->name,
                'This is to inform you that your Supervisor’s has completed the appraisal and ratings are available for your review on the tool. Please proceed to accept the rating if you are in agreement and decline if you’d like to discuss further. Kindly take note that the end date for completion of this exercise is Wednesday 20th January, 2020.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);

            // schedule an email here for supervisor
            dispatch(new MailJob(
                $leader_ship->project->user->email,
                'LeaderShip Appraisal',
                $leader_ship->project->user->email,
                'You have successfully completed the leadership appraisal for ' . $leader_ship->user->name,
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);
        }

        return $this->successResponse([
            'message' => 'The appraisal leadership form has been filled.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param LeaderShip $leaderShip
     * @return JsonResponse
     */
    public function show(LeaderShip $leaderShip): JsonResponse
    {
        return $this->successResponse(
            $leaderShip->load(
                'user',
                'project.user'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param LeaderShip $leaderShip
     * @return void
     */
    public function update(Request $request, LeaderShip $leaderShip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LeaderShip $leaderShip
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(LeaderShip $leaderShip): JsonResponse
    {
        $leaderShip->delete();
        return $this->successResponse($leaderShip);
    }
}
