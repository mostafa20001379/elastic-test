<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Twitter extends Model
{
    public $fillable = [
        'content',
        'name',
        'reviews',
        'image',
        'avatar'
    ];
}
