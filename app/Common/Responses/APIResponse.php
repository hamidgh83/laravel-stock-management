<?php

namespace App\Common\Responses;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class APIResponse
 */
class APIResponse
{
    public const ERROR_KEY = 'code';

    public const MSG_KEY = 'message';

    public const SUCCESS_DATA = 'data';

    public const ERROR_DATA = 'error';

    /**
     * @param $data
     * @param int $statusCode
     * @param array $headers
     *
     * @return JsonResponse
     */
    public static function success($data, int $statusCode = Response::HTTP_OK, $headers = []): JsonResponse
    {
        return static::generateResponse($data, $statusCode, $headers, self::SUCCESS_DATA);
    }

    public static function error(
        string $errorCode,
        $msg,
        int $statusCode = Response::HTTP_BAD_REQUEST,
        array $headers = [],
        array $extraInfo = []
    ): JsonResponse {
        return static::generateResponse(
            array_merge(
                [
                    static::ERROR_KEY => $errorCode,
                    static::MSG_KEY => $msg,
                ],
                $extraInfo,
            ),
            $statusCode,
            $headers,
            self::ERROR_DATA,
        );
    }

    /**
     * @param $data
     * @param int $statusCode
     * @param $headers
     * @param $type string
     *
     * @return JsonResponse
     */
    private static function generateResponse($data, int $statusCode, $headers, $type): JsonResponse
    {
        $response = response()->json(["$type" => $data], $statusCode);

        if (! empty($headers)) {
            $response->withHeaders($headers);
        }

        return $response;
    }
}
