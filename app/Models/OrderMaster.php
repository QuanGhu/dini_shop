<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    protected $table = 'order_master';
    protected $fillable = [
        'order_number', 'user_id','total_order','fullname','address'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function getOrderNumberAttribute($value)
    {
        $defautlLength = 6;
        $getValueLength = strlen($value);
        $createZeroLength = $defautlLength - $getValueLength;
        $zero = str_repeat("0", $createZeroLength);
        $orderNumber = 'A'.$zero.$value;
        return $orderNumber;
    }
}