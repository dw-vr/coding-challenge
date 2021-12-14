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
        return response()->json(Product::all(), Request::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $product = Product::create($request->all());
            return response()->json($product, Request::HTTP_CREATED);
        }
        catch (QueryException $e){
            return response()->json($e->errorInfo[2], Request::HTTP_BAD_REQUEST);
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
        if(isnull($product)){
            return response()->json('Product not found', Request::HTTP_NOT_FOUND);
        }
        else{
            return response()->json($product, Request::HTTP_OK);
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
        return response()->json('Not implemented', Request::HTTP_NOT_IMPLEMENTED);
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
        if(isnull($product)){
            return response()->json('Product not found '. $id, Request::HTTP_NOT_FOUND);
        }
        else{
            $product->name = $request['name'];
            $product->price = $request['price'];
            $product->quantity = $request['quantity'];
            $product->category_id = $request['category_id'];
            $product->save();
            return response()->json($product, Request::HTTP_OK);
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
        return response()->json('', Request::HTTP_NO_CONTENT);
    }
}
