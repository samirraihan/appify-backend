<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $posts = Post::all();
        $comments = Comment::all();

        if ($users->isEmpty()) {
            return;
        }

        // Likes for posts
        foreach ($posts as $post) {
            $count = rand(0, min(10, $users->count()));
            $likers = $users->random($count ?: 0);
            foreach ($likers as $user) {
                Like::firstOrCreate([
                    'user_id' => $user->id,
                    'likeable_type' => Post::class,
                    'likeable_id' => $post->id,
                ]);
            }
        }

        // Likes for comments
        foreach ($comments as $comment) {
            $count = rand(0, min(5, $users->count()));
            $likers = $users->random($count ?: 0);
            foreach ($likers as $user) {
                Like::firstOrCreate([
                    'user_id' => $user->id,
                    'likeable_type' => Comment::class,
                    'likeable_id' => $comment->id,
                ]);
            }
        }
    }
}
