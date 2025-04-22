@extends('default')

@section('title', '投稿一覧')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">新しい投稿を作成</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" id="title" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">本文</label>
                <textarea id="content" name="content" class="form-control" rows="10"></textarea>
            </div>

            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">作成</button>
            </div>
        </form>
    </div>
@endsection