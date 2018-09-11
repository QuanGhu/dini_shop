<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderMaster;
use App\Models\Cart;
use App\Models\Product;
use App\Http\Resources\OrderMaster as OrderMasterResource;
use Crud;
use Auth;
use Storage;

class OrderController extends Controller
{
    public function createOrder(Cart $cart, Order $order, OrderMaster $ordermaster, Product $product,Request $request)
    {
        try {
            $masterOrder = $this->createMasterOrder($ordermaster, $cart, $request);
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

                $this->descreaseQtyProduct($product, $cartItem);
            }

            if($store)
            {
                $delete = Crud::delete($cart,'user_id',Auth::user()->id);

                return response()->json(['status' => true, 'Message' => 'Order Complete']);

            } else {
                return response()->json(['status' => false, 'message' => 'Order Cannot Complete'], 500);
            }


        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function createMasterOrder(OrderMaster $ordermaster, Cart $cart, Request $request)
    {
        try {
            $data['order_number'] = $this->createOrderNumber($ordermaster);
            $data['user_id'] = Auth::user()->id;
            $data['total_order'] = $this->getTotalPriceFromCart($cart);
            $data['ongkir'] = $request->ongkir;
            $data['payment_method'] = $request->payment_method;
            $data['fullname'] = $request->name;
            $data['address'] = $request->address;
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

    public function getOrderHistory(OrderMaster $ordermaster) {
        try {
            $data = Crud::getWhere($ordermaster, 'user_id', Auth::user()->id);
            return (OrderMasterResource::collection($data))->additional([
                'status' => true
            ]);
        }catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function descreaseQtyProduct(Product $product, $data)
    {
        try {

            $getNowQty = CRUD::base($product)->where('id', $data->product->id)->first();
            $resultQty = $getNowQty->stock - $data->qty;
            $update = CRUD::base($product)->where('id', $data->product->id)->update(['stock' => $resultQty]);
            
            return $update ? $update : false;

        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function getBuktiTransfter(Request $request, OrderMaster $ordermaster)
    {
        try {

            $data = $request->all();
            $data['attachment'] = $this->storeImage($request);

            $update = Crud::update($ordermaster, 'id',$request->id,$data);
            
            return $update ? response()->json(['status' => true, 'Message' => 'Upload Success']) 
            : response()->json(['status' => false, 'Message' => 'Upload Failed']);

        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    private function storeImage(Request $request) 
    {
        $image = $request->file('attachment');
        $fileName = time().'.'.$image->getClientOriginalExtension();
        Storage::disk('public')->put('attachment/'.$fileName, file_get_contents($image), 'public');
        
        return $fileName;
    }
}
