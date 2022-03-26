<?php

namespace App\Http\Controllers;

use App\Services\{InstagramGalleyService, TwitterService, InstagramService, NewsService, NotificationService};
use Illuminate\Http\Request;
use Elasticsearch\ClientBuilder;
use App\Http\Requests\IndexRequest;
use OpenApi\Annotations as OA;

class ElasticsearchController extends Controller
{
    private InstagramService $instagramService;
    private TwitterService $twitterService;
    private NewsService $newsService;
    private NotificationService $notificationService;
    private InstagramGalleyService $instagramGalleyService;

    public function __construct(InstagramService $instagramService,
                                TwitterService $twitterService,
                                NewsService $newsService,
                                InstagramGalleyService $instagramGalleyService,
                                NotificationService $notificationService) {
        $this->instagramService = $instagramService;
        $this->twitterService = $twitterService;
        $this->newsService = $newsService;
        $this->instagramGalleyService = $instagramGalleyService;
        $this->notificationService = $notificationService;
        $this->client = ClientBuilder::create()->build();
    }

    /**
     *
     * @OA\Get (
     *  path="/api/elastic/show",
     *  tags={"Elasticsearch"},
     *  summary="Get all data from specific Index",
     *
     *  @OA\Parameter(
     *    name="platform",
     *    in="query",
     *    description="Platform",
     *    @OA\Schema(
     *      type="string",
     *      example="instagram"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="datetime",
     *    in="query",
     *    description="Datetime",
     *    @OA\Schema(
     *      type="date",
     *      example="2001-01-01"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="title",
     *    in="query",
     *    description="Title",
     *    @OA\Schema(
     *      type="string",
     *      example="Hey"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="username",
     *    in="query",
     *    description="Username",
     *    @OA\Schema(
     *      type="string",
     *      example="Adam"
     *    )
     *  ),
     *  @OA\Parameter(
     *    name="name",
     *    in="query",
     *    description="Name",
     *    @OA\Schema(
     *      type="string",
     *      example="Adam"
     *    )
     *  ),
     *
     *  @OA\Response (
     *    response=200,
     *    description="Return Data",
     *    @OA\JsonContent(
     *          @OA\Property(
     *              property="_index",
     *              type="string",
     *              example="instagram"
     *          ),
     *          @OA\Property(
     *              property="_type",
     *              type="string",
     *              example="instagram"
     *          ),
     *          @OA\Property(
     *              property="_id",
     *              type="string",
     *              example="1"
     *          ),
     *          @OA\Property(
     *              property="_score",
     *              type="object",
     *              example="{}"
     *          )
     *      )
     *    )
     *  )
     * )
     *
     */

    public function index(IndexRequest $request)
    {
        $platform = $request['platform'];
        $data = [];

        switch ($platform) {
            case 'instagram':
                $data = $this->instagramService->elasticFind($request);
                break;
            case 'twitter' :
                $data = $this->twitterService->elasticFind($request);
                break;
            case 'news' :
                $data = $this->newsService->elasticFind($request);
                break;
        }

        return $data['hits']['hits'];
    }

    public function store(Request $request)
    {
        $platform = $request['platform'];

        $params = [
            'id' => $request['id'],
            'title' => $request['title'] ?? '',
            'content' => $request['content'] ?? '',
            'name' => $request['name'] ?? '',
            'thumbnail' => $request['thumbnail'] ?? '',
            'username' => $request['username'] ?? '',
            'datetime' => $request['datetime'] ?? '',
            'resource' => $request['resource'] ?? '',
            'link' => $request['link'] ?? '',
            'avatar' => $request['avatar'] ?? '',
            'reviews' => $request['reviews'] ?? '',
            'image' => $request['image'] ?? '',
        ];
        switch ($platform) {
            case 'instagram':
                $data = $this->instagramService->elasticInsert($params);
                break;
            case 'twitter' :
                $data = $this->twitterService->elasticInsert($params);
                break;
            case 'news' :
                $data = $this->newsService->elasticInsert($params);
                break;
        }


        if ($data['result'] == 'created') {
            $notifData = [
                'platform' => $request['platform'],
                'in_queue' => $request['in_queue'] ?? false,
                'send_at' => now()
            ];
            $this->notificationService->notify($request->user(), $notifData);
            return 'Data Inserted';
        }
        return 'Data insertion failed';
    }

    /**
     * @OA\Delete (
     *     path="/api/elastic/delete/{id}",
     *     tags={"Elasticsearch"},
     *     summary="Delete Data from a platform with id",
     *     @OA\Parameter(
     *          name="platform",
     *          in="query",
     *          description="Platform",
     *          @OA\Schema(
     *              type="string",
     *              example="instagram"
     *          )
     *     ),
     *     @OA\Parameter(
     *         description="The id of data",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           example="1"
     *       )
     *     ),
     *
     *  @OA\Response (
     *    response=200,
     *    description="OK",
     *  )
     * )
     */

    public function delete(Request $request)
    {
        $platform = $request['platform'];
        switch ($platform) {
            case 'instagram':
                $data = $this->instagramService->elasticDelete($request);
                break;
            case 'twitter' :
                $data = $this->twitterService->elasticDelete($request);
                break;
            case 'news' :
                $data = $this->newsService->elasticDelete($request);
                break;
        }

        if ($data['result'] = 'deleted') {
            return 'Deleted';
        }

        return 'Delete failed';
    }
}
