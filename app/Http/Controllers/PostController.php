<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    /**
     * 掲示板の一覧を表示する
     *
     * @return View
     */
    public function index(): View
    {
        $posts = Post::query()
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * 投稿の編集画面を表示する
     *
     * @return View
     */
    public function edit($id): View
    {
        $post = Post::find($id);

        return view('posts.edit', [
            'post' => $post
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
        // shim : インスタンス化の文法が間違っています
        // $post = new Post(); のように（）が必要です
        $post = new Post();

        // $requestからinput情報を取得するときはinput()を使いましょう
        // $request->input('title');
        // なくても動作はされますが、これが$requestのプロパティなのか？ユーザinputなのか判断できないので！
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        // この形だとPostのプロパティのsaveというのを取得するだけの処理になります
        // 僕達は保存をしたいので保存の役割を果たすメソッドを呼び出す必要があります
        $post->save();

        // まずは、returnをしてないです。このstore()アクションはRedirectResponseを返さないといけないとPHPDocに書いてあります。
        // リダイレクトのやり方はドキュメントを読んでまた調べてみてください
        return redirect()->route('posts.index');
    }

    /**
     * 更新処理
     * 
     * @param  PostRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        $updatePost = $this->post->updatePost($request, $post);

        return redirect()->route('posts.index');
    }
}
