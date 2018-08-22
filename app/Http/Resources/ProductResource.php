<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name'=>$this->name,
            'details'=>$this->details,
            'price'=>$this->price,
            'stock'=>$this->stock,
            'discount'=>$this->discount,
            'PriceAfterDiscount'=>round($this->price-($this->price*$this->discount/100),2),
            'stars'=>$this->review->count()>0?round($this->review->sum('rating')/$this->review->count(),2):"No Reviews",
            'href'=>[
                'link'=> route('reviews.index', $this->id)
            ]
        ];
    }
}
