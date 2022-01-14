<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Jobs\MailJob;
use App\Models\AssignedProject;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function user(): JsonResponse
    {
        return $this->successResponse(
            request()->user()->load(
                'branch',
                'role',
                'country',
                'team.team_user.user.role',
                'project.assigned_project.user.role',
                'assigned_project.project.user.role',
                'project.assigned_project.user.report',
                'assigned_project.project.user.report',
                'report.key_result_area.key_performance_indicator',
                'result',
                'personal_development.project',
                'behavioral.project',
                'leader_ship.project',
                'escalate.result.user',
            )
        );
    }

    /**
     * Reset user password
     * @param ResetPasswordRequest $request
     * @return JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        // fetch the user here
        $user = $request->user();
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        // dispatch mail job
        dispatch((new MailJob(
            $user->email,
            config('app.name') . ' Account',
            $user->name,
            'Your account password is ' . $request->password . ' .Kindly use it to log in.',
            env('FRONTEND_URL'),
            '<<< LOGIN >>>'
        )))->onQueue('emails')->delay(1);

        return $this->successResponse([
            'message' => 'Password reset successfully for ' . $user->name
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->successResponse(
            User::query()
                ->with([
                    'branch',
                    'role',
                    'country',
                    'team.team_user.user.role',
                    'project.assigned_project.user.role',
                    'assigned_project.project.user.role',
                    'project.assigned_project.user.report',
                    'assigned_project.project.user.report',
                    'report.key_result_area.key_performance_indicator',
                    'result',
                    'personal_development.project',
                    'behavioral.project',
                    'leader_ship.project',
                    'escalate.result.user',
                ])
                ->orderBy('name')
                ->latest()
                ->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function store(UserRequest $request): JsonResponse
    {
        // generate random password
        $password = Str::upper(Str::random(6));

        // store
        $user = User::query()->create([
            'branch_id' => $request->branch_id,
            'country_id' => $request->country_id,
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'employee_number' => $request->employee_number,
            'employee_designation' => $request->employee_designation,
            'password' => bcrypt($password),
            'joining_date' => date('Y-m-d', strtotime($request->joining_date)),
        ]);

        // check if project id is set
        if ($request->filled('project_id')) {
            AssignedProject::query()->updateOrCreate([
                'project_id' => $request->project_id,
                'user_id' => $user->id,
            ]);
        }

        // dispatch mail job
        dispatch((new MailJob(
            $user->email,
            config('app.name') . ' Account',
            $user->name,
            'Your account password is ' . $password . ' .Kindly use it to log in.',
            env('FRONTEND_URL'),
            '<<< LOGIN >>>'
        )))->onQueue('emails')->delay(2);

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return $this->successResponse(
            $user->load(
                'branch',
                'role',
                'country',
                'team.team_user.user.role',
                'project.assigned_project.user.role',
                'assigned_project.project.user.role',
                'project.assigned_project.user.report',
                'assigned_project.project.user.report',
                'report.key_result_area.key_performance_indicator',
                'result',
                'personal_development.project',
                'behavioral.project',
                'leader_ship.project',
                'escalate.result.user',
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        // store
        $user->update([
            'branch_id' => $request->branch_id,
            'country_id' => $request->country_id,
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'employee_number' => $request->employee_number,
            'employee_designation' => $request->employee_designation,
            'is_active' => $request->is_active ?? true,
            'joining_date' => $request->joining_date,
        ]);

        if (isset($request->password) && !is_null($request->password)) {
            // do a user refresh here
            $user->refresh();
            $user->update([
                'password' => bcrypt($request->password)
            ]);

            // dispatch mail job
            dispatch((new MailJob(
                $user->email,
                config('app.name') . ' Account',
                $user->name,
                'Your account password is ' . $request->password . ' .Kindly use it to log in.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            )))->onQueue('emails')->delay(2);
        }

        // check if project id is set
        if (isset($request->project_id)) {
            $assigned_projects = AssignedProject::query()->where('user_id', $user->id)->get();
            if (count($assigned_projects)) {
                // check all the projects the user has
                foreach ($assigned_projects as $assigned) {
                    $assigned->delete();
                }

                // create the new project
                AssignedProject::query()->create([
                    'project_id' => $request->project_id,
                    'user_id' => $user->id,
                ]);
            }

            // send email
            dispatch(new MailJob(
                $user->email,
                'Project Update',
                $user->name,
                'Your project has been updated. Kindly login to continue with the appraisal.',
                env('FRONTEND_URL'),
                '<<< LOGIN >>>'
            ))->onQueue('emails')->delay(2);
        }

        return $this->successResponse($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return $this->successResponse($user);
    }
}
