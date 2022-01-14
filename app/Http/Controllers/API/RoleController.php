<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            Role::query()
                ->with([
                    'user',
                    'key_performance_indicator'
                ])
                ->oldest('name')
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return JsonResponse
     */
    public function store(RoleRequest $request): JsonResponse
    {
        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->level = count($role->toArray()) + 1;
        $role->save();

        return $this->successResponse($role, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        return $this->successResponse(
            $role->load(
                'user',
                'key_performance_indicator'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(RoleRequest $request, Role $role): JsonResponse
    {
        $role->fill($request->validated());
        if ($role->isClean()) {
            return $this->errorResponse('At least one value must change.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $role->save();

        return $this->successResponse($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Role $role): JsonResponse
    {
        $role->delete();
        return $this->successResponse($role);
    }
}
