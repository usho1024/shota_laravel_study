<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\View\View;

class TopController
{
    /**
     * TOPを表示する
     *
     * @return View
     */
    public function index(): View
    {
        $new_posts = Post::withCount('comments')
            ->withTrashed()
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $commented_posts = Post::withCount('comments')
            ->withTrashed()
            ->orderByDesc('comments_count')
            ->limit(5)
            ->get();

        return view('admin.top', [
            'new_posts' => $new_posts,
            'commented_posts' => $commented_posts,
        ]);
    }
}
