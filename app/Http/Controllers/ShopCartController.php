<?php

namespace App\Http\Controllers;

use App\Models\CartModel;
use Illuminate\Http\Request;

class ShopCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $userId =  auth()->user()->id;
        $list = CartModel::where('users_id',$userId)->orderBy('id','desc')->get();

        return view('shop-cart',['items'=>$list]);
    }
    public function count(){
        $userId =  auth()->user()->id;
        $count = CartModel::where('users_id',$userId)->count();
        return $count;
    }
    public function getListItems(){
        $userId =  auth()->user()->id;
        $list = CartModel::where('users_id',$userId)->orderBy('id','desc')->get();

        return $list;
    }
    public function getTotalPrice(){
        $userId =  auth()->user()->id;
        $list = CartModel::where('users_id',$userId)->orderBy('id','desc')->get();
        $total = 0;
        foreach($list as $item){
            $total += $item->c_price ;
        }
        return $total;
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
        // ajax
        $userId =  auth()->user()->id;
        $new=CartModel::create([
            'name'=>$request->name,
            'products_id'=>$request->id,
            'c_price'=>$request->price * $request->quantity,
            'quantity' => $request->quantity,
            'users_id'=>$userId,
        ]);

        return response()->json(['result'=>$new]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //

        $userId =  auth()->user()->id;
        $update = CartModel::find($id)->update([
            'name'=>$request->name,
            'products_id'=>$request->id,
            'c_price'=>$request->price * $request->quantity,
            'quantity' => $request->quantity,
        ]);

        return response()->json(['result'=>$update]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $del = CartModel::find($id)->delete();

        return response()->json(['result'=>$del]);
    }
}
