<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'category_id',
        'des',
        'price',
        'sale_off',
        'vote',
        'slug',
        'tag',
        'quanlity'
    ];


    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function images()
    {
        return $this->hasMany(ImageProducts::class);
    }  
    public function cart()
    {
        return $this->hasMany(CartModel::class);
    }
}
