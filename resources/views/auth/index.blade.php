@extends('default')

@section('title', 'ユーザーログイン')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">ユーザーログイン</h1>

        @error('auth')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <form action="{{ route('login') }}" method="POST">
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
    </div>
@endsection