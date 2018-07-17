<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderMaster;
use App\Models\Cart;
use Crud;
use Auth;

class OrderController extends Controller
{
    public function createOrder(Cart $cart, Order $order, OrderMaster $ordermaster)
    {
        try {
            $masterOrder = $this->createMasterOrder($ordermaster, $cart);
            $cartItems = $this->getItemsFromCart($cart);
            foreach($cartItems as $cartItem)
            {
                $data['product_name'] = $cartItem->product->name;
                $data['product_price'] = $cartItem->product->price;
                $data['qty'] = $cartItem->qty;
                $data['user_id'] = $cartItem->user_id;
                $data['order_master_id'] = $masterOrder->id;
                $data['total_price'] = $cartItem->qty * $cartItem->product->price;
                $store = Crud::save($order, $data);
            }
            
            return $store ? response()->json(['status' => true, 'Message' => 'Order Complete'])
            : response()->json(['status' => false, 'message' => 'Order Cannot Complete'], 500);

        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function createMasterOrder(OrderMaster $ordermaster, Cart $cart)
    {
        try {
            $data['order_number'] = $this->createOrderNumber($ordermaster);
            $data['user_id'] = Auth::user()->id;
            $data['total_order'] = $this->getTotalPriceFromCart($cart);
            $data['fullname'] = Auth::user()->fullname;
            $data['address'] = Auth::user()->address;
            $store = Crud::save($ordermaster, $data);

            return $store;
        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function createOrderNumber(OrderMaster $ordermaster)
    {
        try {

            $data = Crud::base($ordermaster)->where('user_id', Auth::user()->id)->orderBy('order_number', 'DESC')->pluck('order_number')->first();
            return $data ? $data + 1 : 1;
        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function getItemsFromCart(Cart $cart)
    {
        try {
            $data = Crud::getAll($cart)->where('user_id', Auth::user()->id);

            return $data;
        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function getTotalPriceFromCart(Cart $cart)
    {
        try {
            $data = Cart::where('user_id', Auth::user()->id)->sum('total_price');

            return $data;
        } catch (Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }
}
