<?php

namespace App\Http\Controllers;

use App\Builders\PostSearchBuilder;
use App\Enums\SearchCondition;
use App\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * 掲示板の一覧を表示する
     *
     * @return View
     */
    public function index(Request $request): View
    {
        $search_params = $request->only(['keyword', 'condition']);
        $query = PostSearchBuilder::build($search_params);
        $conditions = SearchCondition::cases();

        $posts = $query
            ->withTrashed()
            ->orderByDesc('id')
            ->paginate(20)
            ->appends($search_params);

        return view('posts.index', [
            'posts' => $posts,
            'conditions' => $conditions,
            'search_params' => $search_params
        ]);
    }

    /**
     * 投稿の編集画面を表示する
     *
     * @return View
     */
    public function edit(Post $post): View
    {
        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * 投稿の詳細画面を表示する
     *
     * @return View
     */
    public function show(Post $post): View
    {
        $post->load([
            'comments' => function ($query) {
                $query->whereNull('parent_id');    
                $query->with('user');
                $query->with(['replies' => function ($replyQuery) {
                    $replyQuery->with('user');
                    $replyQuery->orderBy('created_at', 'asc');
                }]);
            }
        ]);
    
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    public function create()
    {
        return view('posts.create'); // 新規投稿フォームのビューを返す
    }

    /**
     * 新規投稿を作成する
     * 
     * @param  PostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $validated_params = $request->validated();
        $validated_params['user_id'] = Auth::id();
        Post::create($validated_params);

        return redirect()->route('posts.index');
    }

    /**
     * 更新処理
     * 
     * @param  PostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $validated_params = $request->validated();

        $post->update([
            'title' => $validated_params['title'],
            'content' => $validated_params['content']
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * 削除処理
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return redirect()->route('posts.index');
    }

    /**
     * 投稿を復元する
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(Post $post): RedirectResponse
    {
        $post->restore();

        return redirect()->route('posts.index');
    }
}
