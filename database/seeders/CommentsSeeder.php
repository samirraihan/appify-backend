<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsSeeder extends Seeder
{
    public function run(): void
    {
        $posts = Post::all();
        $users = User::all();

        if ($posts->isEmpty() || $users->isEmpty()) {
            return;
        }

        foreach ($posts as $post) {
            $count = rand(0, 5);
            for ($i = 0; $i < $count; $i++) {
                Comment::create([
                    'user_id' => $users->random()->id,
                    'post_id' => $post->id,
                    'parent_id' => null,
                    'text' => fake()->sentence(),
                ]);
            }
        }

        // create some nested replies
        $allComments = Comment::all();
        foreach ($allComments->random(min(10, $allComments->count())) as $comment) {
            Comment::create([
                'user_id' => $users->random()->id,
                'post_id' => $comment->post_id,
                'parent_id' => $comment->id,
                'text' => fake()->sentence(),
            ]);
        }
    }
}
