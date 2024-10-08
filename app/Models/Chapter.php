<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    protected $table = 'chapter';
    protected $fillable = [
        'title',
        'content',
        'story_id'
    ];

    public function story()
    {
        return $this->belongsTo(Story::class);
    }
}
