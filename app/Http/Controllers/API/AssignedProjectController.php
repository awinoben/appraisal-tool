<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssignedProjectRequest;
use App\Models\AssignedProject;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AssignedProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            AssignedProject::query()
                ->with([
                    'project.user',
                    'user'
                ])
                ->latest()
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AssignedProjectRequest $request
     * @return JsonResponse
     */
    public function store(AssignedProjectRequest $request): JsonResponse
    {
        // loop through
        if (count($request->users)) {
            foreach ($request->users as $user) {
                AssignedProject::query()->updateOrCreate([
                    'project_id' => $request->project_id,
                    'user_id' => $user
                ]);
            }
        }
        return $this->successResponse([
            'message' => 'Assigned ' . count($request->users) . ' members to project.'
        ], Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param AssignedProject $assignedProject
     * @return JsonResponse
     */
    public function show(AssignedProject $assignedProject): JsonResponse
    {
        return $this->successResponse(
            $assignedProject->load(
                'project.user',
                'user'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AssignedProjectRequest $request
     * @param AssignedProject $assignedProject
     * @return JsonResponse
     */
    public function update(AssignedProjectRequest $request, AssignedProject $assignedProject): JsonResponse
    {
        $assignedProject->fill($request->validated());
        if ($assignedProject->isClean()) {
            return $this->errorResponse('At least one value must change.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $assignedProject->save();

        return $this->successResponse($assignedProject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param AssignedProject $assignedProject
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(AssignedProject $assignedProject): JsonResponse
    {
        $assignedProject->delete();
        return $this->successResponse($assignedProject);
    }
}
