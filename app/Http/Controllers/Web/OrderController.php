<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderMaster;
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
                <button type="button" class="btn btn-info btn-cons btn-sm btn-small edit">Update</button>
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
}
