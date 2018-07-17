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
                'status' => true, 'cart_badge' => Cart::where('user_id',Auth::user()->id)->count(),
                'total_price_cart' => Cart::where('user_id', Auth::user()->id)->sum('total_price')
            ]);
        } catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function removeItemFromCart(Request $request, Cart $cart)
    {
        try {
            $store = Crud::delete($cart, 'id', $request->id);
            return $store ? response()->json(['status' => true]) : response()->json(['status' => false]);
        } catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }
}
