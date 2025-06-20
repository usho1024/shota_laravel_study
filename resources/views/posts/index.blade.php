@extends('default')

@section('title', '投稿一覧')

@section('content')
    <h1>投稿一覧</h1>

    <form action="{{ route('posts.index') }}" method="GET">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="start_date" value="{{ $search_params['start_date'] ?? '' }}" class="form-control" id="start-date" placeholder="開始日を選択...">
            <input type="text" name="end_date" value="{{ $search_params['end_date'] ?? '' }}" class="form-control" id="end-date" placeholder="終了日を選択...">

            <select name="condition" class="form-select">
                @foreach ($conditions as $condition)
                    <option value="{{ $condition->value }}" @selected(($search_params['condition'] ?? '') === $condition->value)>
                        {{ $condition->label() }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="keyword" value="{{ $search_params['keyword'] ?? '' }}" class="form-control">
            <button type="submit" class="btn btn-primary">検索</button>
        </div>
    </form>

    <div class="container mt-4">
        <div class="row">
            @foreach ($posts as $post)
                @if($post->isUnmanageableHiddenPost())
                    @continue
                @endif

                <div class="col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card h-100">
                        <div @class([
                            'card-body',
                            'bg-secondary-subtle' => $post->isManageableHiddenPost()
                        ])>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                            <div>
                                <small class="text-muted">投稿日: {{ $post->created_at->format('Y-m-d H:i') }}</small>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success">詳細</a>
                            @can('manage-post', $post)
                                @if ($post->is_hidden)
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#restoreModal{{ $post->id }}">再表示</button>
                                @else
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">編集</a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $post->id }}">非表示</button>
                                @endif
                            @endcan
                        </div>
                    </div>
                </div>

                @component('components.modal.hide', [
                    'table_name' => 'posts',
                    'table_text' => '投稿',
                    'model' => $post,
                ])
                @endcomponent

                @component('components.modal.display', [
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