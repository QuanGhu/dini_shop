<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Role;
use Crud;

class UserController extends Controller
{
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $role = $this->getAllRoles();
        $title = 'Daftar Pengguna';
        return view('user')->with('role', $role)->with('title',$title);
    }

    public function getAllRoles()
    {
        return Crud::getAll($this->role)->pluck('name','id');
    }

    public function save(Request $request, User $user)
    {
        $data = $request->all();
        $data['password'] = bcrypt('12345678');
        $store = Crud::save($user, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function list(User $user)
    {

        $data = Crud::getAll($user);
        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            return '
                <button type="button" class="btn btn-info btn-cons btn-sm btn-small edit">Update</button>
            ';
        })->editColumn('role', function ($model) {
            return $model->role->name;
        })->editColumn('status', function ($model) {
            return $model->status ? 'Aktif' : 'Tidak Aktif';
        })->addIndexColumn()->make(true);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();
        unset($data['_token']);
        $store = Crud::update($user, 'id', $request->id, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }
}
