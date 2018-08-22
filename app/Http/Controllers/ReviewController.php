<?php

namespace App\Http\Controllers;

use App\Review;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return $product->review->count()>0? ReviewResource::collection($product->review) : "No Reviews"; 
       //return Review::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, Product $product)
    {
        
        $review = new Review($request->all());
        $product->review()->save($review); 
        return response([
            'data'=>new ReviewResource($review)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return new ProductResource($review);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product, Review $review)
    {
        $review->update($request->all());
        return response([
            'data'=>new ReviewResource($review)
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Review $review)
    {
        $review->delete();
        return response([],204);
    }
}
