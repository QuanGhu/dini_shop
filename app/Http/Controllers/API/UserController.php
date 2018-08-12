<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Auth;
use Crud;
use Hash;

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

    public function changePassword(Request $request, User $user)
    {   
        if(Hash::check($request->old_password, Auth::user()->password))
        {
            if($request->new_password != $request->confirm_password) {
                return response()->json(['success' => false, 'message' => 'Password Baru dan Konfirmasi Password Tidak Sama']);  
            }           
            $data['password'] = bcrypt($request->new_password);
            $store = Crud::update($user, 'id',Auth::user()->id,$data);

            return $store ? response()->json(['success' => true , 'message' => 'Data Updated Successfuly'])
                        : response()->json(['success' => true, 'message' => 'Something Went Wrong']);
        }
        else
        {           
            return response()->json(['success' => false, 'message' => 'Password Lama Tidak Benar']);  
        }
    }
}
