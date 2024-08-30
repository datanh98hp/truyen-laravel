<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = [
        'name',
        'users_id',
        'products_id',
        'c_price',
        'quantity',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'users_id');
    }
    public function products()
    {
        return $this->belongsTo(Products::class,'products_id');
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
   
    ////
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

}
