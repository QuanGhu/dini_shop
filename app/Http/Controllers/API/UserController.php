<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Auth;
use Crud;

class UserController extends Controller
{
    public function getMyProfileData(User $user)
    {
        try {
            $currentLogin = Auth::user()->id;
            return new UserResource(User::findOrFail($currentLogin));
        } catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }

    }
}
