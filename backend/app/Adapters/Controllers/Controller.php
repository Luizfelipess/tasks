<?php

namespace App\Adapters\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    public function successResponse(mixed $response): JsonResponse
    {
        return response()->json([
            'data' => $response,
            'status_code' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
