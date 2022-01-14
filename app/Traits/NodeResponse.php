<?php


namespace App\Traits;


use App\Http\Resources\API;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

trait NodeResponse
{
    /**
     * success response
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse($data, int $code = Response::HTTP_OK): JsonResponse
    {
        if (method_exists((object)$data, 'links')) {
            return API::collection($data)
                ->additional([
                    'success' => true
                ])
                ->response()
                ->setStatusCode($code);
        }

        if ($data instanceof Collection) {
            return API::collection($data)
                ->additional([
                    'success' => true
                ])
                ->response()
                ->setStatusCode($code);
        }

        // proceed
        return (new API($data))
            ->additional([
                'success' => true
            ])
            ->response()
            ->setStatusCode($code);
    }

    /**
     * error response
     * @param $message
     * @param $code
     * @return JsonResponse
     */
    public function errorResponse($message, $code): JsonResponse
    {
        return (new API([
            array(
                'key' => 'Message',
                'errors' => array($message)
            )
        ]))->additional([
            'success' => false,
        ])->response()->setStatusCode($code);
    }

    /**
     * system error responses
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    public function showErrors($data, int $code = Response::HTTP_UNPROCESSABLE_ENTITY): JsonResponse
    {
        return (new API($data))
            ->additional([
                'success' => false
            ])->response()->setStatusCode($code);
    }
}
