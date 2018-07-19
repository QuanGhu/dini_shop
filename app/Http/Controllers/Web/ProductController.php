<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Product;
use Yajra\Datatables\Datatables;
use Crud;
use Validator;
use Storage;
use Image;
use Session;

class ProductController extends Controller
{
    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        $categories = $this->getAllCategories();
        $title = 'Daftar Produk';
        return view('product')->with('categories', $categories)->with('title',$title);
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
                <button type="button" class="btn btn-warning btn-cons btn-sm btn-small image">Image</button>
                <button type="button" class="btn btn-danger btn-cons btn-sm btn-small delete">Delete</button>
            ';
        })->editColumn('categories', function ($model) {
                return $model->category->name;
        })->addIndexColumn()->make(true);
    }

    public function uploadNewImage(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);

        if ($validator->fails()) {
            Session::flash('danger',$validator->errors());
            return \Redirect::route('product');
        }

        $checkData = Crud::getSingleData($product, 'id', $request->id);
        if($checkData->image)
        {
            $delete = Storage::disk('public')->delete('product/'.$checkData->image);
        }
        $image = $request->file('image');
        $fileName = time().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());
        $img->resize(512, 512, function ($constraint) {
            $constraint->aspectRatio();                 
        });
        $img->stream();
        Storage::disk('public')->put('product/'.$fileName, $img, 'public');
        $data['image'] = $fileName;

        $store = Crud::update($product, 'id', $request->id, $data);

        if($store)
        {
            Session::flash('success','Gambar Produk Berhasil Di Ganti');
            return \Redirect::route('product');
        } else {
            Session::flash('danger','Gambar Produk Tidak Bisa Di ganti');
            return \Redirect::route('product');
        }
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
