<?php

namespace App\Services;

use App\Models\News;

class NewsService extends Service
{
    protected function model()
    {
        return News::class;
    }
}
