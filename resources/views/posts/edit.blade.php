@extends('default')

@section('title', '投稿編集')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">投稿ID: {{ $post->id }}を編集</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', $post->title) }}">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="content" class="form-label">本文</label>
                <textarea id="content" name="content" class="form-control" rows="10">{{ old('content', $post->content) }}</textarea>
            </div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </form>
    </div>
@endsection