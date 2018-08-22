<?php

namespace App;
use App\Review;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'name', 'details' , 'stock', 'price' ,'discount'
    ];
    public function review(){
        return $this->hasMany(Review::class);
    }
}
