<?php

namespace App\Services;

use App\Models\Twitter;
use Elasticsearch\ClientBuilder;

class TwitterService extends Service
{
    private $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    protected function model()
    {
        return Twitter::class;
    }

    public function elasticInsert(array $index)
    {
        $data = [
            'body' => [
                'content' => $index['content'],
                'name' => $index['name'],
                'reviews' => $index['reviews'],
                'image' => $index['image'],
                'avatar' => $index['avatar'],
                'datetime' => $index['datetime']
            ],
            'id' => $index['id'],
            'index' => 'twitter',
            'type' => 'twitter'
        ];

        return $this->client->index($data);
    }

    public function elasticFind($request)
    {
        $params = [
            'index' => 'twitter',
            'type' => 'twitter',
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => []
                    ]
                ]
            ]
        ];
        $datetime = $request['datetime'];
        if($datetime)
            $params['body']['query']['bool']['must'][] = array('match' => ['datetime' => $datetime]);
        $title = $request['title'];
        if($title)
            $params['body']['query']['bool']['must'][] = array('match' => ['title' => $title]);
        $username = $request['username'];
        if($username)
            $params['body']['query']['bool']['must'][] = array('match'=> ['username' => $username]);
        $name = $request['name'];
        if($name)
            $params['body']['query']['bool']['must'][] = array('match' => ['name' => $name]);

        return $this->client->search($params);
    }

    public function elasticDelete($request)
    {
        $params = [
            'index' => 'twitter',
            'id' => $request['id']
        ];

        return $this->client->delete($params);
    }
}
