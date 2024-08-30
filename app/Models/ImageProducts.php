<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ImageProducts extends Model
{
    use HasFactory;
    protected $table = 'products_img';
    protected $fillable = [
        'product_id',
        'slug',
        'tag',
        'img'
    ];
    protected $guarded = [];
    public function product() 
    {
        return $this->belongsTo(Products::class,'id','product_id');
    }
}
