<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Generator;
use App\Services\SlugService;
use App\Models\Screencast\Tag;
use Illuminate\Database\Seeder;
use App\Models\Screencast\Playlist;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $tags = Tag::all();

        $tags->each(function ($tag) use ($faker) {
            $playlists = Playlist::create([
                'name' => 'Tutorial ' . $tag->name,
                'user_id' => rand(2, User::count()),
                'slug' => SlugService::slug(['Tutorial ' . $tag->name], false),
                'price' => rand(200000, 1000000),
                'description' => $faker->sentence(rand(5, 15)),
            ]);
            $playlists->tags()->sync(rand(1, Tag::count()));
        });
    }
}
