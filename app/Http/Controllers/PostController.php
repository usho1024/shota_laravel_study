<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * 掲示板の一覧を表示する
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Post::query()->get();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }
}
