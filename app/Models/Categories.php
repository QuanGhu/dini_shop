<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'name', 'description'
    ];

    public function product()
    {
        return $this->hasMany('App\Models\Product','categories_id');
    }
}
