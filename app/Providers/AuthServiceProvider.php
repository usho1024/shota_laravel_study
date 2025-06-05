<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('manage-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('manage-comment', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('view-post', function (?User $user, Post $post) {
            if ($post->is_hidden) {
                if ($user && $user->id === $post->user_id) {
                    return true;
                }

                return false;
            }

            return true;
        });
    }
}
