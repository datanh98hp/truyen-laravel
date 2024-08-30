<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyCustomer extends Model
{
    use HasFactory;
    protected $table = 'reply_customers';
    protected $fillable = [
        'name',
        'email',
        'message',
        'status'
    ];
    
}
