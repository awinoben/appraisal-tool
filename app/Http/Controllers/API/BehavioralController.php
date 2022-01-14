<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BehavioralRequest;
use App\Jobs\MailJob;
use App\Models\Behavioral;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BehavioralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            Behavioral::query()
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
     * @param BehavioralRequest $request
     * @return JsonResponse
     */
    public function store(BehavioralRequest $request): JsonResponse
    {
        $behavioral = null;

        // loop through the behavioral data
        foreach ($request->behavioral as $data) {
            $behavioral = Behavioral::query()
                ->with(['user', 'project.user'])
                ->where('id', $data['id'])
                ->first();

            if ($behavioral)
                $behavioral->update([
                    'employee_ratings' => $data['employee_ratings'],
                    'employee_comments' => $data['employee_comments'],
                    'supervisor_ratings' => $data['supervisor_ratings'],
                    'supervisor_comments' => $data['supervisor_comments'],
                    'is_rated' => true
                ]);

            // update the user
            $behavioral->user->update([
                'is_evaluated' => true
            ]);
        }

        if ($behavioral) {
            // schedule an email here for user
            dispatch(new MailJob(
                $behavioral->user->email,
                'Behavioral Appraisal',
                $behavioral->user->name,
                'This is to inform you that your Supervisor’s has completed the appraisal and ratings are available for your review on the tool. Please proceed to accept the rating if you are in agreement and decline if you’d like to discuss further. Kindly take note that the end date for completion of this exercise is Wednesday 20th January, 2020.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);

            // schedule an email here for supervisor
            dispatch(new MailJob(
                $behavioral->project->user->email,
                'Behavioral Appraisal',
                $behavioral->project->user->email,
                'You have successfully completed the behavioral appraisal for ' . $behavioral->user->name,
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);
        }

        return $this->successResponse([
            'message' => 'The appraisal behavioral form has been filled.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Behavioral $behavioral
     * @return JsonResponse
     */
    public function show(Behavioral $behavioral): JsonResponse
    {
        return $this->successResponse(
            $behavioral->load(
                'user',
                'project.user'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Behavioral $behavioral
     * @return void
     */
    public function update(Request $request, Behavioral $behavioral)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Behavioral $behavioral
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Behavioral $behavioral): JsonResponse
    {
        $behavioral->delete();
        return $this->successResponse($behavioral);
    }
}
