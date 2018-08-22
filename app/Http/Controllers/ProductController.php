<?php

namespace App\Http\Controllers;
//use vendor\Symfony\Response;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use Auth;
class ProductController extends Controller
{
    public function __construct(){
            $this->middleware('auth:api')->except('index', 'show');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductCollection::collection(product::paginate(20));
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
    public function store(ProductRequest $request)
    {
        $nproduct=new Product;
        $nproduct->name=$request->name;
        $nproduct->details=$request->details;
        $nproduct->stock=$request->stock;
        $nproduct->discount = $request->discount;
        $nproduct->price= $request->price;
        $nproduct->save();
        return new ProductResource($nproduct);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        /*$uproduct = Product::find($product);
        $uproduct->name= $request->name;
        $uproduct->details=$request->details;
        $uproduct->stock=$request->stock;
        $uproduct->price=$request->price;
        $uproduct->discount= $request->discount;
        $uproduct->save();
        return new ProductResource($uproduct);*/
        if(Auth::id()== $product->user_id){
            $product->update($request->all());
            return new ProductResource($product);
        }
        else{
            return response()->json([
                'error'=>'product does not belong to you' //not being displayed for some reason :/
            ],204 );
        }
        //return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(Auth::id()==$product->user_id){
            $product->delete();
            if(!$product->delete()){
                return "product deleted sed :( "; //response function isnt working
            }
            else{
                return "some error occurred ";
            }
        
        }
        else{
            return response()->json([
                'error'=>'product does not belong to you' //not being displayed for some reason :/
            ],204);
        }
    }
}
