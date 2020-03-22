<?php

namespace App\Http\Controllers\api;

use App\Sales;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MakeSalesResource;

class MakeSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
       return  Sales::all();
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
    public function store(Request $request)
    {
        $salesData = $request->input('newdatas');
        // return ($salesData);
        foreach($salesData as $unitData){
         $product = Product::where('id' ,$unitData['product_id']);
         $product_name = $product->first()->product_name;
         $product_in_count = $product->first()->product_count;
         $product_price = $product->first()->product_price;
         $unitNet = $unitData['unitTotal'] - ($product_price*$unitData['product_quantity']);
         $product_new_count = $product_in_count - $unitData['product_quantity'];
        //  return($product_new_count);
         $product->update(['product_count' => $product_new_count]);
         Sales::create([
            'product_quantity'=>$unitData['product_quantity'],
            'product_cost'=>$unitData['product_cost'],
            'product_id'=>$unitData['product_id'],
            'product' => $product_name,
            'discount'=>$unitData['discount'],
            'unitTotal'=>$unitData['unitTotal'],
            'unitNet' => $unitNet,

         ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Sales::where('id',$id)->first();
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
        $this->validate($request, [
            'product_quantity' => 'required',
            'product_cost' => 'required', 
            'product_id' => 'required',  
            'unitTotal' => 'required'
        ]);
        Sales::where('id' , $id)->update(
            $request->all()
        );
        return ['success'=>'true'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sales::where('id' , $id)->delete();
        return ['success'=>'true'];
    }
    public function loadSales(){
       return  count(Sales::all());
        
    }

    public function todaySales(){
       return  Sales::whereDate('created_at', Carbon::today())->get();
     
    //    return  new MakeSalesResource($response);


    }
}
