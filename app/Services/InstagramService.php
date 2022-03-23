<?php

namespace App\Services;

use App\Models\Instagram;

class InstagramService extends Service
{
    protected function model()
    {
        return Instagram::class;
    }
}
