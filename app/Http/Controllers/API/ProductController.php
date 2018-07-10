<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Http\Resources\Product as ProductResource;
use Crud;
use Auth;

class ProductController extends Controller
{
    public function getProductByCategory(Product $product, $id)
    {
        try {
            $data = Crud::getWhere($product, 'categories_id', $id);
            return (ProductResource::collection($data))->additional([
                'status' => true
            ]);
        }catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function getProductDetail($id)
    {
        try {
            return new ProductResource(Product::findOrFail($id));
        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }

    public function addProductToCart(Request $request,Cart $cart)
    {
        try {

            $data = $request->all();
            $data['user_id'] = Auth::user()->id;
            $save = Crud::save($cart, $data);
            $badge = Cart::where('user_id',Auth::user()->id)->count();
            return $save ? response()->json(['status' => true, 'Message' => 'Product Successfuly add to cart','badge' => $badge])
                    : response()->json(['status' => false, 'message' => 'Product cannot add to cart'], 500);

        } catch(Exception $e)
        {
            return response()->json(['status' => false, 'message' => $e], 500);
        }
    }
}
