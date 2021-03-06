<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            'name' => $this->name,
            'price' => 'Rp '.$this->price,
            'stock' => $this->stock,
            'image' => asset("storage/product/".$this->image),
            'status' => $this->status,
            'category' => new Categories($this->category),
            'description' => $this->description
        ];
    }
}
