<?php

namespace App\Services;

use App\Models\Twitter;

class TwitterService extends Service
{
    protected function model()
    {
        return Twitter::class;
    }
}
