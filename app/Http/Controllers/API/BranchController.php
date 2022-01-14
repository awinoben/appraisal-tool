<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            Branch::query()
                ->orderBy('name')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BranchRequest $request
     * @return JsonResponse
     */
    public function store(BranchRequest $request): JsonResponse
    {
        return $this->successResponse(
            Branch::query()->create($request->validated()),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Branch $branch
     * @return JsonResponse
     */
    public function show(Branch $branch): JsonResponse
    {
        return $this->successResponse(
            $branch->load(
                'user',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BranchRequest $request
     * @param Branch $branch
     * @return JsonResponse
     */
    public function update(BranchRequest $request, Branch $branch): JsonResponse
    {
        $branch->fill($request->validated());
        if ($branch->isClean()) {
            return $this->errorResponse('At least one value must change.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $branch->save();

        return $this->successResponse($branch);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Branch $branch
     * @return JsonResponse
     */
    public function destroy(Branch $branch): JsonResponse
    {
        $branch->delete();
        return $this->successResponse($branch);
    }
}
