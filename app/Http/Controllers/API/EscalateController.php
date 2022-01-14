<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\EscalateRequest;
use App\Models\Escalate;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class EscalateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            Escalate::query()
                ->with([
                    'user',
                    'result.project.user',
                    'result.project.assigned_project.user',
                ])
                ->latest()
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param EscalateRequest $request
     * @return JsonResponse
     */
    public function store(EscalateRequest $request): JsonResponse
    {
        return $this->successResponse(
            Escalate::query()->updateOrCreate($request->validated()),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Escalate $escalate
     * @return JsonResponse
     */
    public function show(Escalate $escalate): JsonResponse
    {
        return $this->successResponse(
            $escalate->load(
                'user',
                'result.project.user',
                'result.project.assigned_project.user',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param EscalateRequest $request
     * @param Escalate $escalate
     * @return JsonResponse
     */
    public function update(EscalateRequest $request, Escalate $escalate): JsonResponse
    {
        $escalate = Escalate::query()->findOrFail($request->id);
        $escalate->update([
            'is_closed' => $request->is_closed
        ]);

        return $this->successResponse($escalate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Escalate $escalate
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Escalate $escalate): JsonResponse
    {
        $escalate->delete();
        return $this->successResponse($escalate);
    }
}
