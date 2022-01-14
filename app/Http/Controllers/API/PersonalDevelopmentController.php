<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonalDevelopmentRequest;
use App\Jobs\MailJob;
use App\Models\PersonalDevelopment;
use Exception;
use Illuminate\Http\JsonResponse;

class PersonalDevelopmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            PersonalDevelopment::query()
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
     * @param PersonalDevelopmentRequest $request
     * @return JsonResponse
     */
    public function store(PersonalDevelopmentRequest $request): JsonResponse
    {
        $personal = null;

        // loop through the personal data
        foreach ($request->personal as $data) {
            $personal = PersonalDevelopment::query()
                ->with(['user', 'project.user'])
                ->where('id', $data['id'])
                ->first();

            if ($personal)
                $personal->update([
                    'personal_development' => $data['personal_development'],
                    'what_to_do' => $data['what_to_do'],
                    'achievement' => $data['achievement'],
                    'actions' => $data['actions'],
                    'manager_comments' => $data['manager_comments'],
                    'on_track' => $data['on_track'],
                    'reject_comments' => $data['reject_comments'],
                    'is_rated' => true
                ]);

            if (!is_null($data['manager_comments'])) {
                // update the user
                $personal->user->update([
                    'is_evaluated' => true
                ]);
            }
        }

        if ($personal) {
            // schedule an email here for user
            dispatch(new MailJob(
                $personal->user->email,
                'Personal Development Plan Status',
                $personal->user->name,
                'This is to inform you that your Supervisor’s has completed the appraisal and ratings are available for your review on the tool. Please proceed to accept the rating if you are in agreement and decline if you’d like to discuss further.',
                env('FRONTEND_URL'),
                '<<< CHECK STATUS >>>'
            ))->onQueue('emails')->delay(2);

            // schedule an email here for supervisor
            dispatch(new MailJob(
                $personal->project->user->email,
                'Personal Development Plan Review',
                $personal->project->user->email,
                'You have successfully completed the review for personal development plan for ' . $personal->user->name,
                env('FRONTEND_URL'),
                '<<< CHECK STATUS >>>'
            ))->onQueue('emails')->delay(2);
        }

        return $this->successResponse([
            'message' => 'The appraisal personal development form has been filled.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param PersonalDevelopment $personalDevelopment
     * @return JsonResponse
     */
    public function show(PersonalDevelopment $personalDevelopment): JsonResponse
    {
        return $this->successResponse(
            $personalDevelopment->load(
                'user',
                'project.user'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PersonalDevelopmentRequest $request
     * @param PersonalDevelopment $personalDevelopment
     * @return void
     */
    public function update(PersonalDevelopmentRequest $request, PersonalDevelopment $personalDevelopment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PersonalDevelopment $personalDevelopment
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(PersonalDevelopment $personalDevelopment): JsonResponse
    {
        $personalDevelopment->delete();
        return $this->successResponse($personalDevelopment);
    }
}
