<?php

namespace App\Services;

use App\Models\InstagramGallery;
use Elasticsearch\ClientBuilder;

class InstagramGalleyService extends Service
{
    private $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    protected function model()
    {
        return InstagramGallery::class;
    }

    public function elasticInsert(array $index)
    {
        $data = [
            'body' => [
                'instagram_id' => $index['instagram_id'],
                'link' => $index['link'],
                'type' => $index['type'],
                'datetime' => $index['datetime']
            ],
            'id' => $index['id'],
            'index' => 'instagram_gallery',
            'type' => 'instagram'
        ];

        $this->client->index($data);
    }
}
