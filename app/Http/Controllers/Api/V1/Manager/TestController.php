<?php

namespace App\Http\Controllers\Api\V1\Manager;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function test()
    {
        return response()->json([
            'status' => true,
            'message' => 'Test Api Works successfully',
        ], 200);
    }
}
