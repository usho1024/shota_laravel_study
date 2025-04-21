@extends('default')

@section('title', '投稿一覧')

@section('content')
    <h1>投稿一覧</h1>

    <div class="container mt-4">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card h-100">

                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>

                            <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                        </div>
                        <div class="card-footer text-end">
                            <small class="text-muted">投稿日: {{ $post->created_at->format('Y-m-d H:i') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection