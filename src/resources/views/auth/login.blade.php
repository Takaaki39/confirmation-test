@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endsection

@section('header_button')
    <a href="/register" class="header-btn">register</a>
@endsection

@section('contents')

<div class="auth-form">
    <div class="auth-form__heading font-color">
        Login
    </div>
    <div class="login-container">
        <div>
            <form class="form-wrapper" action="/login" method="post">
                @csrf
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input name="email" type="email" id="email" placeholder="例: test@example.com">
                    <div class="error-message">
                        @error('email')
                        {{$errors->first('email')}}
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input name="password" type="password" id="password" placeholder="例: coachtech1106">
                    <div class="error-message">
                        @error('password')
                        {{$errors->first('password')}}
                        @enderror
                    </div>
                </div>
                <button type="submit" class="login-button">ログイン</button>
            </form>
        </div>
    </div>
</div>
@endsection