<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\PostRequest;
use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use RuntimeException;

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

        Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $validated_params['post_id'],
            'parent_id' => $validated_params['parent_id'] ?: null ,
            'content' => $validated_params['content'],
        ]);

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
        try {
            DB::beginTransaction();

            $comment->replies()->delete();
            $comment->delete();

            DB::commit();
        } catch (RuntimeException $e) {
            Log::error($e->getMessage());

            DB::rollBack();
        }

        return redirect()->back();
    }
}
