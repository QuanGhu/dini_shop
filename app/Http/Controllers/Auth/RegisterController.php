<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Crud;

class RegisterController extends Controller
{
    public function registerNewUser(Request $request, User $user)
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $data['role_id'] = 3;
            $store = Crud::save($user, $data);

            return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
        } catch (Exception  $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
        
    }
}
