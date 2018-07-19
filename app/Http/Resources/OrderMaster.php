<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderMaster extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'total_order' => 'Rp '.$this->total_order,
            'fullname' => $this->fullname,
            'address' => $this->address,
            'status' => $this->status
        ];
    }
}
