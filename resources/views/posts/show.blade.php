@extends('default')

@section('title', '投稿詳細')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">投稿ID: {{ $post->id }}</h1>

        <div class="mb-3">
            <h3>タイトル</h3>
            <p>{{ $post->title }}</p>
        </div>

        <div class="mb-3">
            <h3>本文</h3>
            <p>{{ $post->content }}</p>
        </div>

        <div class="mb-3 d-flex justify-content-end">
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">一覧に戻る</a>
        </div>
    </div>
@endsection