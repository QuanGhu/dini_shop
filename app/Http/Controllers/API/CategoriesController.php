<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Http\Resources\Collection\CategoriesCollection as DataCollection;
use Crud;

class CategoriesController extends Controller
{
    public function getAll(Categories $categories)
    {
        try {
            $data = Crud::getAll($categories);
            return new DataCollection($data);

        } catch (Exception $e) {
            return response()->json(['status' => 'false', 'message' => $e], 500);
        }

    }
}
