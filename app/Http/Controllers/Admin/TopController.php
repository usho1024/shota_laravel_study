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
        $posts = Post::query()
            ->withTrashed()
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return view('admin.top', [
            'posts' => $posts,
        ]);
    }
}
