<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\KRARequest;
use App\Models\KeyResultArea;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class KRAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            KeyResultArea::query()
                ->with([
                    'key_performance_indicator.role',
                    'report'
                ])
                ->latest()
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param KRARequest $request
     * @return JsonResponse
     */
    public function store(KRARequest $request): JsonResponse
    {
        return $this->successResponse(KeyResultArea::query()->create($request->validated()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param KeyResultArea $keyResultArea
     * @return JsonResponse
     */
    public function show(KeyResultArea $keyResultArea): JsonResponse
    {
        return $this->successResponse(
            $keyResultArea->load(
                'key_performance_indicator.role',
                'report'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param KRARequest $request
     * @param KeyResultArea $keyResultArea
     * @return JsonResponse
     */
    public function update(KRARequest $request, KeyResultArea $keyResultArea): JsonResponse
    {
        $keyResultArea->fill($request->validated());
        if ($keyResultArea->isClean()) {
            return $this->errorResponse('At least one value must change.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $keyResultArea->save();

        return $this->successResponse($keyResultArea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param KeyResultArea $keyResultArea
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(KeyResultArea $keyResultArea): JsonResponse
    {
        $keyResultArea->delete();
        return $this->successResponse($keyResultArea);
    }
}
