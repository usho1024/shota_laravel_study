@extends('default')

@section('title', '投稿詳細')

@section('content')
    <div class="container mt-4">
        <div class="border rounded p-3 mb-4">
            <h4 class="mb-3">投稿ID: {{ $post->id }}</h4>
    
            <div class="mb-3">
                <h4>タイトル</h4>
                <p>{{ $post->title }}</p>
            </div>
    
            <div class="mb-3">
                <h4>本文</h4>
                <p>{{ $post->content }}</p>
            </div>
        </div>

        <div class="mb-4 p-3">
            <h4>コメント</h4>
            @foreach ($post->comments as $comment)
                <div class="border-bottom p-3">
                    <div>No.{{ $loop->index+1 }}</div>
                    <p>{{ $comment->user->email }} さん</p>
                    <p>{{ $comment['content'] }}</p>
                    <div>{{ $comment['created_at'] }}</div>
                    @can('manage-comment', $comment)
                        <div class="mt-3">
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary">編集</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $comment->id }}">削除</button>
                        </div>
                    @endcan
    
                    @component('components.modal.delete', [
                        'table_name' => 'comments',
                        'table_text' => 'コメント',
                        'model' => $comment,
                    ])
                    @endcomponent
                </div>
            @endforeach
        </div>

        @auth
            <div class="mb-4">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                    <div>
                        <textarea name="content" rows="5" class="form-control mb-3"></textarea>
                    </div>

                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div>
                        <button type="submit" class="btn btn-primary">コメントを投稿</button>
                    </div>
                </form>
            </div>
        @endauth

        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">一覧に戻る</a>
        </div>
    </div>
@endsection