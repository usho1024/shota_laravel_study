@extends('default')

@section('title', '管理TOP')

@section('content')
    <h1>管理TOP</h1>

    <div class="container mt-4">
        <div class="row">
            <div class="col-6 p-3">
                <h3>最新順</h3>

                @foreach ($new_posts as $post)
                    <div class="col-12 mb-4">
                        <div class="card h-100">
                            <div @class([
                                'card-body',
                            ])>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                                <div>
                                    <small class="text-muted">投稿日: {{ $post->created_at->format('Y-m-d H:i') }}　コメント数: {{ $post->comments_count }}</small>
                                </div>
                            </div>

                            @if (!$post->trashed())
                                <div class="text-end m-3"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">削除</button></div>
                            @else
                                <p class="p-3">削除済み</p>
                            @endif
                        </div>
                    </div>

                    @component('components.modal.delete', [
                        'table_name' => 'posts',
                        'table_text' => '投稿',
                        'model' => $post,
                    ])
                    @endcomponent
                @endforeach
            </div>

            <div class="col-6 p-3">
                <h3>コメントが多い順</h3>

                @foreach ($commented_posts as $post)
                    <div class="col-12 mb-4">
                        <div class="card h-100">
                            <div @class([
                                'card-body',
                            ])>
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                                <div>
                                    <small class="text-muted">投稿日: {{ $post->created_at->format('Y-m-d H:i') }}　コメント数: {{ $post->comments_count }}</small>
                                </div>
                            </div>

                            @if (!$post->trashed())
                                <div class="text-end m-3"><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">削除</button></div>
                            @else
                                <p class="p-3">削除済み</p>
                            @endif
                        </div>
                    </div>

                    @component('components.modal.delete', [
                        'table_name' => 'posts',
                        'table_text' => '投稿',
                        'model' => $post,
                    ])
                    @endcomponent
                @endforeach
            </div>
        </div>
    </div>
@endsection