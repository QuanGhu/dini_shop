<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\Models\Categories;
use Crud;

class CategoriesController extends Controller
{
    public function index()
    {
        return view('categories');
    }

    public function save(Request $request, Categories $categories)
    {
        $data = $request->all();
        $store = Crud::save($categories, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function list(Categories $categories)
    {

        $data = Crud::getAll($categories);
        return Datatables::of($data)->addColumn('action', function ($model) {
            return '
                <button type="button" class="btn btn-info btn-cons btn-sm btn-small edit">Update</button>
                <button type="button" class="btn btn-danger btn-cons btn-sm btn-small delete">Delete</button>
            ';
        })->addIndexColumn()->make(true);
    }

    public function delete(Request $request, Categories $categories)
    {
        $data = $request->id;
        $delete = Crud::delete($categories, 'id', $data);

        return $delete ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function update(Request $request, Categories $categories)
    {
        $data = $request->all();
        unset($data['_token']);
        $store = Crud::update($categories, 'id', $request->id, $data);

        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }
}
