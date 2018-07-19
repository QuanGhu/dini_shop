<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderMaster;
use App\Models\Order;
use Crud;
use Yajra\Datatables\Datatables;

class OrderController extends Controller
{
    public function index()
    {
        return view('order');
    }

    public function list(OrderMaster $ordermaster)
    {

        $data = Crud::getAll($ordermaster);
        return Datatables::of($data)->addColumn('action', function ($model) {
            return '
                <a href="'.route('order.detail', $model->id).'" class="btn btn-info btn-cons btn-sm btn-small edit">Proses</a>
            ';
        })->editColumn('customer_email', function ($model) {
            return $model->user->email;
        })->addIndexColumn()->make(true);
    }

    public function update(Request $request, Role $role)
    {
        $data = $request->all();
        unset($data['_token']);
        $store = Crud::update($role, 'id', $request->id, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function detail($id, OrderMaster $ordermaster)
    {
        $data = OrderMaster::findOrFail($id);
        $orders = Order::where('order_master_id', $id)->get();
        return view('orderdetail')->with('data', $data)->with('orders',$orders);
    }
}
