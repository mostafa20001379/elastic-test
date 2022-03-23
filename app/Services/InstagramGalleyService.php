<?php

namespace App\Services;

use App\Models\InstagramGallery;

class InstagramGalleyService extends Service
{
    protected function model()
    {
        return InstagramGallery::class;
    }
}
