<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'fee',
        'users_id',
        'price_order',
        'discount',
        'status'
    ];

    public function cart(){
        return $this->hasOne(CartModel::class);
    }
    public function voucher(){
        return $this->hasOne(Voucher_code::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }
}
