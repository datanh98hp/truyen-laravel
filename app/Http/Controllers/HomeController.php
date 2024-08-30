<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReqCustomerRequest;
use App\Models\Categories;
use App\Models\Products;
use App\Models\ReplyCustomer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Categories::all();
        $products   = Products::where('tag','feature')->get();
        $latestProduct = Products::orderBy('created_at','desc')->take(6)->get();
        
        return view('Home',['categories'=>$categories,'products'=>$products,'latestProduct'=>$latestProduct]);
    }
    public function shop()
    {   
        
        //
        //$categories = Categories::all();
        $products   = Products::orderBy('id','desc')->paginate(9);
        $listSalePrd = Products::where('sale_off', '>', '0')->orderBy('id', 'desc')->get();
        $latestProduct = Products::orderBy('created_at','desc')->take(6)->get();
        return view('shop',['products'=>$products,'latestProduct'=>$latestProduct,'listSalePrd'=>$listSalePrd]);
    }
    public function contactPage(){

        return view('contact');
    }
    public function createRequestCustomer(StoreReqCustomerRequest $request){
        
        ReplyCustomer::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
            'status'=>'recieved'
        ]);

        return back()->with('status','Message was sended !');
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
        //
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
    }
}
