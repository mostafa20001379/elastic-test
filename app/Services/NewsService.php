<?php

namespace App\Services;

use App\Models\News;
use Elasticsearch\ClientBuilder;

class NewsService extends Service
{
    private $client;

    public function __construct()
    {
        $this->client = ClientBuilder::create()->build();
    }

    protected function model()
    {
        return News::class;
    }

    public function elasticInsert(array $index)
    {
        $data = [
            'body' => [
                'title' => $index['title'],
                'resource' => $index['resource'],
                'content' => $index['content'],
                'link' => $index['link'],
                'avatar' => $index['avatar'],
                'datetime' => $index['datetime']
            ],
            'id' => $index['id'],
            'index' => 'news',
            'type' => 'news'
        ];

        return $this->client->index($data);
    }

    public function elasticFind($request)
    {
        $params = [
            'index' => 'news',
            'type' => 'news',
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
            'index' => 'news',
            'id' => $request['id']
        ];

        return $this->client->delete($params);
    }
}
