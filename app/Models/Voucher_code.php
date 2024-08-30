<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher_code extends Model
{
    use HasFactory;
    protected $table = 'voucher_code';
    protected $fillable = [
        'code',
        'discount',
        'expire_date'
    ];
    

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
