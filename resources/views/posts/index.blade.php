@extends('default')

@section('title', '投稿一覧')

@section('content')
    <h1>投稿一覧</h1>

    <div class="container mt-4">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div @class(['card-body', 'bg-secondary-subtle' => $post->deleted_at])>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <small class="text-muted">投稿日: {{ $post->created_at->format('Y-m-d H:i') }}</small>
                            
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">詳細</a>
                            @can('manage-post', $post)
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集</a>
                                @if ($post->deleted_at)
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $post->id }}">削除取消</button>
                                @else
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">削除</button>
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>

                @component('components.modal.delete', [
                    'table_name' => 'posts',
                    'model' => $post,
                ])
                @endcomponent

                @component('components.modal.restore', [
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