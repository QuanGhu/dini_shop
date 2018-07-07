<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Crud;

class ProductController extends Controller
{
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->getAllCategories();
        return view('product')->with('categories', $categories);
    }

    public function getAllCategories()
    {
        return Crud::getAll($this->categories)->pluck('name','id');
    }

    public function save(Request $request, Product $product)
    {
        $data = $request->all();
        $store = Crud::save($product, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function list(Product $product)
    {

        $data = Crud::getAll($product);
        return Datatables::of($data)
        ->addColumn('action', function ($model) {
            return '
                <button type="button" class="btn btn-info btn-cons btn-sm btn-small edit">Update</button>
                <button type="button" class="btn btn-danger btn-cons btn-sm btn-small delete">Delete</button>
            ';
        })->editColumn('categories', function ($model) {
                return $model->category->name;
        })->addIndexColumn()->make(true);
    }

    public function delete(Request $request, Product $product)
    {
        $data = $request->id;
        $delete = Crud::delete($product, 'id', $data);

        return $delete ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->all();
        unset($data['_token']);
        $store = Crud::update($product, 'id', $request->id, $data);
        
        return $store ? response()->json(['status' => 'success']) : response()->json(['status' => 'false']);
    }
}
