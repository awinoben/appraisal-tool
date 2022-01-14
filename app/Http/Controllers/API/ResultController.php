<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Jobs\GenerateReportJob;
use App\Jobs\MailJob;
use App\Models\Escalate;
use App\Models\Result;
use Exception;
use Illuminate\Http\JsonResponse;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            Result::query()
                ->with([
                    'user',
                    'project.user',
                    'report.user',
                    'report.project.user',
                    'escalate.user'
                ])
                ->whereIn('project_id', [request()->user()->project ? request()->user()->project->id : null])
                ->latest()
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ResultRequest $request
     * @return void
     */
    public function store(ResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Result $result
     * @return JsonResponse
     */
    public function show(Result $result): JsonResponse
    {
        return $this->successResponse(
            $result->load(
                'user',
                'project.user',
                'report.user',
                'report.project.user',
                'escalate.user'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ResultRequest $request
     * @param Result $result
     * @return JsonResponse
     */
    public function update(ResultRequest $request, Result $result): JsonResponse
    {
        // get the models
        $result->load('user', 'project.user');

        // update the result
        $result->update([
            'is_accepted' => $request->is_accepted,
            'is_rejected' => $request->is_rejected
        ]);

        // check the request outcome
        if ($request->is_accepted) {
            // start generating user report
            dispatch(new GenerateReportJob(
                $result->user->employee_number,
                $result->user_id,
                $result->project_id,
                $result->user->name
            ))->onQueue('default')->delay(2);

            // dispatch the email here user
            dispatch(new MailJob(
                $result->user->email,
                'Technical/Functional Appraisal Acceptance',
                $result->user->name,
                'You have accepted the rating done by your supervisor. This will be used as a performance key gauge.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);

            // dispatch the email here supervisor
            dispatch(new MailJob(
                $result->project->user->email,
                'Technical/Functional Appraisal Acceptance',
                $result->project->user->name,
                $result->user->name . ' has accepted the rating given.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);
        }

        if ($request->is_rejected) {
            // create a escalation here to supervisor
            Escalate::query()->updateOrCreate([
                'user_id' => $result->project->user->id,
                'result_id' => $result->id
            ]);

            // dispatch the email here user
            dispatch(new MailJob(
                $result->user->email,
                'Performance Objectives Appraisal Rejection',
                $result->user->name,
                'You have rejected the rating done by your supervisor.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);

            // dispatch the email here supervisor
            dispatch(new MailJob(
                $result->project->user->email,
                'Performance Objectives Appraisal Rejection',
                $result->project->user->name,
                'You have received an escalation for user ' . $result->user->name . ' (' . $result->user->email . ')',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);
        }

        return $this->successResponse($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Result $result
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Result $result): JsonResponse
    {
        $result->delete();
        return $this->successResponse($result);
    }
}
