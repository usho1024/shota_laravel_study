@extends('default')

@section('title', '管理TOP')

@section('content')
    <h1>管理TOP</h1>

    <div class="container mt-4">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div @class([
                            'card-body',
                        ])>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                            <div>
                                <small class="text-muted">投稿日: {{ $post->created_at->format('Y-m-d H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>

                @component('components.modal.delete', [
                    'table_name' => 'posts',
                    'table_text' => '投稿',
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
@endsection