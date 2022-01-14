<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\KPIRequest;
use App\Models\KeyPerformanceIndicator;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class KPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            KeyPerformanceIndicator::query()
                ->with([
                    'role',
                    'key_result_area'
                ])
                ->latest()
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KPIRequest $request
     * @return JsonResponse
     */
    public function store(KPIRequest $request): JsonResponse
    {
        return $this->successResponse(
            KeyPerformanceIndicator::query()->create([
                'role_id' => $request->role_id,
                'key_result_area_id' => $request->key_result_area_id,
                'description' => $request->description,
            ]),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param KeyPerformanceIndicator $keyPerformanceIndicator
     * @return JsonResponse
     */
    public function show(KeyPerformanceIndicator $keyPerformanceIndicator): JsonResponse
    {
        return $this->successResponse(
            $keyPerformanceIndicator->load(
                'role',
                'key_result_area'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KPIRequest $request
     * @param KeyPerformanceIndicator $keyPerformanceIndicator
     * @return JsonResponse
     */
    public function update(KPIRequest $request, KeyPerformanceIndicator $keyPerformanceIndicator): JsonResponse
    {
        $keyPerformanceIndicator->fill($request->validated());
        if ($keyPerformanceIndicator->isClean()) {
            return $this->errorResponse('At least one value must change.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $keyPerformanceIndicator->save();

        return $this->successResponse($keyPerformanceIndicator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param KeyPerformanceIndicator $keyPerformanceIndicator
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(KeyPerformanceIndicator $keyPerformanceIndicator): JsonResponse
    {
        $keyPerformanceIndicator->delete();
        return $this->successResponse($keyPerformanceIndicator);
    }
}
