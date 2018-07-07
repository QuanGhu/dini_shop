<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name', 'price', 'stock' ,'image', 'status', 'categories_id'
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Categories','categories_id');
    }
}
