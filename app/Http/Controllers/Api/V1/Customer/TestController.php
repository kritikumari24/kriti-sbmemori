<?php

namespace App\Http\Controllers\Api\V1\Customer;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function test()
    {
        return response()->json([
            'status' => true,
            'message' => 'Customer Test Api Works successfully',
        ], 200);
    }
}
