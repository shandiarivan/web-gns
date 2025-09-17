<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
    'title', 
    'description', 
    'image1', 
    'image2', 
    'image3', 
    'is_published',
    'published_at' 
    ];
}

