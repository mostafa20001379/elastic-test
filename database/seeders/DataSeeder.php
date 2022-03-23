<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Services\{InstagramService, TwitterService, NewsService, InstagramGalleyService};

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
            $this->instagramService->insert([
                'title' => $faker->realText($maxNbChars = 20),
                'content' => $faker->realText,
                'name' => $faker->name,
                'thumbnail' => $faker->imageUrl,
                'username' => $faker->userName
            ]);
        }

        for ($i=0; $i<100; $i++) {
            $this->twitterService->insert([
                'content' => $faker->realText,
                'name' => $faker->name,
                'reviews' => $faker->randomNumber(),
                'image' => $faker->imageUrl,
                'avatar' => $faker->imageUrl
            ]);
        }

        for ($i=0; $i<100; $i++) {
            $this->newsService->insert([
                'title' => $faker->realText($maxNbChars = 20),
                'resource' => $faker->url,
                'content' => $faker->realText,
                'link' => $faker->url,
                'avatar' => $faker->imageUrl
            ]);
        }

        for ($i=0; $i<100; $i++) {
            $this->instagramGalleyService->insert([
                'instagram_id' => $faker->numberBetween($min=1, $max=100),
                'link' => $faker->url,
                'type' => $faker->numberBetween($min=1, $max=2)
            ]);
        }
    }
}
