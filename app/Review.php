<?php

namespace App;
use App\Product;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user', 'rating', 'review'
    ];
    
    public function review(){
        return $this->belongsTo(Product::class);
    }
}
