<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthorizeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function __invoke(AuthRequest $request): JsonResponse
    {
        if ($token = auth()->guard('api')->attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => true])) {
            // Authentication passed respond back with bearer token...
            return $this->respondWithToken($token);
        }

        return $this->errorResponse('Wrong credentials or user has been suspended from the system.', Response::HTTP_UNAUTHORIZED);
    }
}
