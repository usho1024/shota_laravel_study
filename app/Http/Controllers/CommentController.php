<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController
{
    /**
     * コメントを作成する
     * 
     * @param  CommentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CommentRequest $request): RedirectResponse
    {
        $validated_params = $request->validated();
        $validated_params['user_id'] = Auth::id();
        $validated_params['post_id'] = $request->input('post_id');
        Comment::create($validated_params);

        return redirect()->back();
    }

    public function edit(Comment $comment): View
    {
        return view('comments.edit', [
            'comment' => $comment
        ]);
    }

    public function update(CommentRequest $request, Comment $comment): RedirectResponse
    {
        $validated_params = $request->validated();
        $comment->update([
            'content' => $validated_params['content']
        ]);

        return redirect()->route('posts.show', $comment->post->id);
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->back();
    }
}
