<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Services\{InstagramService, TwitterService, NewsService, InstagramGalleyService};
use Elasticsearch\ClientBuilder;

class DataSeeder extends Seeder
{
    private InstagramService $instagramService;
    private TwitterService $twitterService;
    private NewsService $newsService;
    private InstagramGalleyService $instagramGalleyService;

    public function __construct(InstagramService $instagramService,
                                TwitterService $twitterService,
                                NewsService $newsService,
                                InstagramGalleyService $instagramGalleyService) {
        $this->instagramService = $instagramService;
        $this->twitterService = $twitterService;
        $this->newsService = $newsService;
        $this->instagramGalleyService = $instagramGalleyService;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i<100; $i++) {
            $this->instagramService->elasticInsert([
                'id' => $i,
                'title' => $faker->realText($maxNbChars = 20),
                'content' => $faker->realText,
                'name' => $faker->name,
                'thumbnail' => $faker->imageUrl,
                'username' => $faker->userName,
                'datetime' => $faker->date($format = 'Y-m-d', $max = 'now') // '1979-06-09'
            ]);
        }

        for ($i=0; $i<100; $i++) {
            $this->twitterService->elasticInsert([
                'id' => $i,
                'content' => $faker->realText,
                'name' => $faker->name,
                'reviews' => $faker->randomNumber(),
                'image' => $faker->imageUrl,
                'avatar' => $faker->imageUrl,
                'datetime' => $faker->date($format = 'Y-m-d', $max = 'now') // '1979-06-09'
            ]);
        }

        for ($i=0; $i<100; $i++) {
            $this->newsService->elasticInsert([
                'id' => $i,
                'title' => $faker->realText($maxNbChars = 20),
                'resource' => $faker->url,
                'content' => $faker->realText,
                'link' => $faker->url,
                'avatar' => $faker->imageUrl,
                'datetime' => $faker->date($format = 'Y-m-d', $max = 'now') // '1979-06-09'
            ]);
        }

        for ($i=0; $i<100; $i++) {
            $this->instagramGalleyService->elasticInsert([
                'id' => $i,
                'instagram_id' => $faker->numberBetween($min=1, $max=100),
                'link' => $faker->url,
                'type' => $faker->numberBetween($min=1, $max=2),
                'datetime' => $faker->date($format = 'Y-m-d', $max = 'now') // '1979-06-09'
            ]);
        }
    }
}
