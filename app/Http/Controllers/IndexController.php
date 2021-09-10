<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function index()
    {
        $result = [
            'status' => 'Success',
            'code' => 200,
            'data' => 'Success test api'
        ];

        return new JsonResponse($result, 200);
    }
}
