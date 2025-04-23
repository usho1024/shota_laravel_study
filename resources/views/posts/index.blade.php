@extends('default')

@section('title', '投稿一覧')

@section('content')
    <h1>投稿一覧</h1>

    <div class="container mt-4">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                        </div>
                            <div class="card-footer text-end">
                            <small class="text-muted">投稿日: {{ $post->created_at->format('Y-m-d H:i') }}</small>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集</a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">削除</button>
                        </div>
                    </div>
                </div>

                @component('components.modal.delete', [
                    'table_name' => 'posts',
                    'model' => $post,
                ])
                @endcomponent
            @endforeach
        </div>
    </div>

    <div class="d-flex justify-content-end">
        {{ $posts->links() }}
    </div>
@endsection