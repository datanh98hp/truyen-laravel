<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    public $timestamps = false;
    protected $fillable = [
        'logo',
        "store_name",
        'banner',
        'contentBanner_left',
        'contentBanner_right',
        'contentBanner_heading',
        'email',
        'phone',
        'address',
        "city",
        'pos_code',
        'opentime',
        'facebook_url',
        'tiktok_url',
        'map_key', 
    ];

}
