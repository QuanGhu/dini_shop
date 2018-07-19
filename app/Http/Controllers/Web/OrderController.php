<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderMaster;
use App\Models\Order;
use Crud;
use Yajra\Datatables\Datatables;
use Session;
use Mail;

class OrderController extends Controller
{
    public function index()
    {
        $title = 'Daftar Pemesanan';
        return view('order')->with('title',$title);
    }

    public function list(OrderMaster $ordermaster)
    {

        $data = Crud::getAll($ordermaster);
        return Datatables::of($data)->addColumn('action', function ($model) {
            if($model->status === 'Belum Di Proses') {
                return ' <a href="'.route('order.detail', $model->id).'" class="btn btn-info btn-cons btn-sm btn-small edit">Proses</a>';
            } else {
                return '';
            };
        })->editColumn('customer_email', function ($model) {
            return $model->user->email;
        })->editColumn('order_number', function ($model) {
            return $model->createOrderNumber();
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
        $title = 'Detail Pemesanan';
        return view('orderdetail')->with('data', $data)->with('orders',$orders)->with('title',$title);
    }

    public function processOrder($id)
    {
        $data = OrderMaster::where('id', $id)->update(['status' => 'Sudah Di Proses']);
        $getData = OrderMaster::findOrFail($id);
        if($data) {
            $email = $getData->user->email;
            Mail::send('email.order', ['data' => $getData], function($message) use ($email) {
                $message->to($email,'Order Telah Di Proses')
                        ->subject('Pemberitahuan Order Anda Telah Di Proses');
            });
            Session::flash('success','Order Telah Di Proses');
            return redirect()->route('order');
        } else {
            Session::flash('success','Order Tidak Bisa Di Proses');
            return redirect()->route('order');
        }
    }
}
