<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Models\Report;
use Exception;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            Report::query()
                ->with([
                    'user.result',
                    'project',
                    'key_result_area'
                ])
                ->latest()
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RatingRequest $request
     * @return JsonResponse
     */
    public function store(RatingRequest $request): JsonResponse
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
                    'reject_comments' => $rating['reject_comments'],
                    'is_rated' => true,
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
        }

        return $this->successResponse([
            'message' => 'The appraisal technical/functional form has been filled successfully.'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Report $report
     * @return JsonResponse
     */
    public function show(Report $report): JsonResponse
    {
        return $this->successResponse(
            $report->load(
                'user.result',
                'project',
                'key_result_area'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RatingRequest $request
     * @param Report $report
     * @return void
     */
    public function update(RatingRequest $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Report $report
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Report $report): JsonResponse
    {
        $report->delete();
        return $this->successResponse($report);
    }
}
