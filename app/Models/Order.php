<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';
    protected $fillable = [
        'product_name', 'product_price','qty','total_price','user_id','order_master_id'
    ];

    public function orderMaster()
    {
        return $this->belongsTo('App\Models\OrderMaster','order_master_id');
    }

}
