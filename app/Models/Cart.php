<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = [
        'qty', 'product_id', 'session_token' ,'user_id', 'total_price'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
