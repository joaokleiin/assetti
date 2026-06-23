<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;

abstract class Controller extends BaseController
{
    protected function notFoundResponse(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => 'Registro não encontrado',
        ], 404);
    }
}
