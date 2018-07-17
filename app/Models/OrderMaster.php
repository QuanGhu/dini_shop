<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    protected $table = 'order_master';
    protected $fillable = [
        'order_number', 'user_id','total_order','fullname','address'
    ];

    // public function category()
    // {
    //     return $this->belongsTo('App\Models\Categories','categories_id');
    // }
}
