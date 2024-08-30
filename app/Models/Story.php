<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'story';
    protected $fillable = [
        'title',
        'thumImg',
        'category_id',
        'slug',
        'tag',
        'des'
    ];
    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
