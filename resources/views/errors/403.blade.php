@extends('default')

@section('content')
<div class="container">
    <h1>403 - Forbidden</h1>
    <h4 class="mb-3">このページへのアクセスは禁止されています。</h4>
    
    @if ($message)
        <p>{{ $message }}</p>
    @endif
    
    <p class="mt-3"><a href="{{ route('posts.index') }}">投稿一覧に戻る</a></p>
</div>
@endsection