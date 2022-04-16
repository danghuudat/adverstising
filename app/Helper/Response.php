<?php

namespace App\Helper;

use Illuminate\Http\Response as HttpResponse;

/**
 * Response Class helper
 */
class Response
{
    /**
     * @param array $data
     * @param string $message
     * @param int $code
     * @param bool $success
     * @return \Illuminate\Http\JsonResponse
     */
    public static function data($data = [], $code = HttpResponse::HTTP_OK, $success = true)
    {
        $dataFormat = [
            'success' => $success,
            'data' => $data,
            'code' => $code
        ];
        return response()->json($dataFormat);
    }

    /**
     * @param $exceptionCode
     * @param $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public static function dataError($exceptionCode, $message = 'Error', int $code = HttpResponse::HTTP_INTERNAL_SERVER_ERROR)
    {
        $dataFormat = [
            'success' => false,
            'message' => $message,
            'code' => $exceptionCode
        ];
        return response()->json($dataFormat, $code);
    }
}
