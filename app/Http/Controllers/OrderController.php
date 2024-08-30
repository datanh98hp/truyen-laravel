<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::all();
        return view('admin.order-list', compact('orders'));
    }

    public function filterByStatus(Request $request)
    {
        //
        $stt = '';
        if($request->status=='cancel'){
            $stt = "24";
        }else if($request->status='payment'){
            $stt = "00";
        }
        // $categories = Order::orderBy('id', 'desc')->get();
        if ($request->status !== null) {
            $orders   = Order::where('status',$stt)
                ->orderBy('id', 'desc')->get();
        } else {
            $orders   = Order::orderBy('id', 'desc')->get();
        }
        $data = [];

        foreach ($orders as $order) {
            $user = $order->user;
            array_push($data, ['order' => $order,'user'=> $user]);
        }
        
        return response()->json(['result' => $data]);

    }
    public function filterByTime(Request $request)
    {
        $startDate = $request->startDate;
        $endDate   = $request->endDate;
        $today     = date('Y-m-d');
        if ($startDate == $endDate || $startDate == $today) {
            $orders   = Order::whereDate('created_at', $startDate)->orderBy('id', 'desc')->get();
        } else {
            $orders   = Order::whereBetween('created_at', [$startDate, $endDate])
                ->orderBy('id', 'desc')->get();
        }

        $data = [];

        foreach ($orders as $order) {
           
            array_push($data, ['product' => $order]);
        }

        return response()->json(['result' => $data]);
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
