<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function test()
    {
        return response()->json(['message' => 'test']);
    }

    public function withAuth()
    {
        return response()->json(['success' => true]);
    }
}
