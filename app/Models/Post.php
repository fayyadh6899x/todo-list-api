<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'tasks';
    protected $fillable = [
        'title',
        'brand',
        'platform',
        'due_date',
        'payment',
        'status', 
        'priority',
        'category', 
    ];
}
