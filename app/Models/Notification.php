<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'url',
        'platform',
        'in_queue',
        'send_at',
        'received_at',
        'read_at'
    ];

}
