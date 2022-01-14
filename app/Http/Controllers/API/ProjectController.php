<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            Project::query()
                ->with([
                    'country',
                    'user.role',
                    'assigned_project.user',
                    'report',
                    'result',
                    'personal_development.user',
                    'behavioral.user',
                    'leader_ship.user',
                ])
                ->latest()
                ->orderBy('name')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return JsonResponse
     */
    public function store(ProjectRequest $request): JsonResponse
    {
        return $this->successResponse(
            Project::query()->create($request->validated()),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return JsonResponse
     */
    public function show(Project $project): JsonResponse
    {
        return $this->successResponse(
            $project->load(
                'country',
                'user.role',
                'assigned_project.user',
                'report',
                'result',
                'personal_development.user',
                'behavioral.user',
                'leader_ship.user',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProjectRequest $request
     * @param Project $project
     * @return JsonResponse
     */
    public function update(ProjectRequest $request, Project $project): JsonResponse
    {
        $project->fill($request->validated());
        if ($project->isClean()) {
            return $this->errorResponse('At least one value must change.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $project->save();

        return $this->successResponse($project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Project $project): JsonResponse
    {
        $project->delete();
        return $this->successResponse($project);
    }
}
