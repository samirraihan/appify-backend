<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class FeedSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure there are some public posts for the feed
        Post::factory()->count(10)->state(function (array $attributes) {
            return ['is_public' => true];
        })->create();
    }
}
