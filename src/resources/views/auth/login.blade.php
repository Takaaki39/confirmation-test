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


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="form-container">
        <form class="form" action="/login" method="post">
            @csrf
            <div class="form-email">
                <span>メールアドレス</span>
                <input type="email" name="email" placeholder="例)test@example.com">
            </div>
            <div class="form-password">
                <span>パスワード</span>
                <input type="password" name="password" placebolder="例)coachtech1106">
            </div>
            <button class="form-button">ログイン</button>
        </form>
    </div>
</div>
@endsection