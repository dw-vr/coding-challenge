<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $httpResultCode=201;
        try{
            $product = Product::create($request->all());
            return response()->json($product, $httpResultCode);
        }
        catch (QueryException $e){
            $httpResultCode=400;
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                return response()->json("Duplicate entry", $httpResultCode);
            }
            elseif($error_code == 1364){
                //some required data missing
                return response()->json($e->errorInfo[2], $httpResultCode);
            }
            else{
                //A lot of things can go bad. This probably needs to be logged for further analysis
                return response()->json('Unknow error', $httpResultCode);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sku)
    {
        //
        $product = Product::where('sku', '=', $sku)->first();
        if($product===null){
            return response()->json('Product not found', 404);
        }
        else{
            return response()->json($product, 200);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return response()->json('Edit Not implemented', 501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id);
        if($product===null){
            return response()->json('Product not found '. $id, 404);
        }
        else{
            $product->name = $request['name'];
            $product->price = $request['price'];
            $product->quantity = $request['quantity'];
            $product->category_id = $request['category_id'];
            $product->save();
            return response()->json($product, 200);
        }
            
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json('', 204);
    }
}
