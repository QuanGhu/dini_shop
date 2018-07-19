<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Role;
use Crud;

class RoleController extends Controller
{
    public function index()
    {
        $title = 'Daftar Hak Akses';
        return view('role')->with('title', $title);
    }

    public function save(Request $request, Role $role)
    {
        $data = $request->all();
        $store = Crud::save($role, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function list(Role $role)
    {

        $data = Crud::getAll($role);
        return Datatables::of($data)->addColumn('action', function ($model) {
            return '
                <button type="button" class="btn btn-info btn-cons btn-sm btn-small edit">Update</button>
            ';
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
