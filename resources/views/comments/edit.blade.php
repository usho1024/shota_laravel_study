@extends('default')

@section('title', 'コメント編集')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">コメントID: {{ $comment->id }}を編集</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="content" class="form-label">本文</label>
                <textarea id="content" name="content" class="form-control" rows="10">{{ old('content', $comment->content) }}</textarea>
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