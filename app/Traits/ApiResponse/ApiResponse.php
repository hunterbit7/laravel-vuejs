<?php

namespace App\Traits\ApiResponse;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * @param $data
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    private function successResponse ($data, $message, int $code): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'result' => $data], $code);
    }

    /**
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function errorResponse ($message, int $code): JsonResponse
    {
        return response()->json([
            'status' => 'failed',
            'error' => $message,
            'code' => $code], $code);
    }

    /**
     * @param $data
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function showResult ($data, $message, int $code = 200): JsonResponse
    {
        return $this->successResponse($data, $message, $code);
    }

    /**
     * @param $message
     * @param int $code
     * @return JsonResponse
     */
    protected function showMessage ($message, int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'message' => $message], $code);
    }
}
