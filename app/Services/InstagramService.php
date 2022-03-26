<?php

namespace App\Services;

use App\Models\Instagram;
use Elasticsearch\ClientBuilder;

class InstagramService extends Service
{
    private $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    protected function model()
    {
        return Instagram::class;
    }

    public function elasticInsert(array $index)
    {
        $data = [
            'body' => [
                'title' => $index['title'],
                'content' => $index['content'],
                'name' => $index['name'],
                'thumbnail' => $index['thumbnail'],
                'username' => $index['username'],
                'datetime' => $index['datetime']
            ],
            'id' => $index['id'],
            'index' => 'instagram',
            'type' => 'instagram'
        ];

        return $this->client->index($data);
    }

    public function elasticFind($request)
    {
        $params = [
            'index' => 'instagram',
            'type' => 'instagram',
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
            'index' => 'instagram',
            'id' => $request['id']
        ];

        return $this->client->delete($params);
    }
}
