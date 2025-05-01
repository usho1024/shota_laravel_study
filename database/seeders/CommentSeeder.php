<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()
            ->with(['posts.comments'])
            ->get();
        
        foreach ($users as $user) {
            foreach($user->posts as $post) {
                $parent_comment = Comment::create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                    'parent_id' => null,
                    'content' => random_int(0,1000000000),
                ]);

                for ($i = 0; $i <= 5; $i++) {
                    Comment::create([
                        'user_id' => $user->id,
                        'post_id' => $post->id,
                        'parent_id' => $parent_comment->id,
                        'content' => random_int(0,1000000000),
                    ]); 
                }
            }
        }
    }
}
