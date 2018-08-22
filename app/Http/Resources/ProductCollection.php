<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,
            'price'=>$this->price,
            'discount'=>$this->discount,
            'PriceAfterDiscount'=>round($this->price-($this->price*$this->discount/100),2),
            'stars'=>$this->review->count()>0?round($this->review->sum('rating')/$this->review->count(),2):"No Reviews",
            'href'=>[
                'link'=> route('products.show', $this->id)
            ]
        ];
    }
}
