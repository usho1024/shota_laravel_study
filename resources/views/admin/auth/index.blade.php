@extends('default')

@section('title', '管理者ログイン')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">管理者ログイン</h1>

        @error('auth')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">email</label>
                <input type="mail" id="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">ログイン</button>
            </div>
        </form>

        <div class="text-center mt-5">
            <a href="{{ route('index') }}">ユーザーログイン</a>
        </div>
    </div>
@endsection