<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Http\Resources\Cart as CartResource;
use Crud;
use Auth;

class CartController extends Controller
{
    public function getAllData(Cart $cart)
    {
        try {
            $data = Crud::getWhere($cart,'user_id',Auth::user()->id);
            return (CartResource::collection($data))->additional([
                'status' => true
            ]);
        } catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }
}
