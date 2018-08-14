<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMaster extends Model
{
    protected $table = 'order_master';
    protected $fillable = [
        'order_number', 'user_id','total_order','fullname','address',
        'ongkir','payment_method'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order','order_master_id');
    }

    public function createOrderNumber()
    {
        $defautlLength = 6;
        $getValueLength = strlen($this->order_number);
        $createZeroLength = $defautlLength - $getValueLength;
        $zero = str_repeat("0", $createZeroLength);
        $orderNumber = 'A'.$zero.$this->order_number;
        return $orderNumber;
    }
}