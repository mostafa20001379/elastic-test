<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instagram extends Model
{
    public $fillable = [
        'title',
        'content',
        'name',
        'thumbnail',
        'username'
    ];
}
