@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">
@endsection

@section('header_button')
    <a href="/admin" class="header-btn">login</a>
@endsection

@section('contents')
<div class="auth-form">
    <div class="auth-form__heading font-color">
        Register
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
        <form class="form" action="/register" method="post">
            @csrf
            <div class="form-name">
                <span>お名前</span>
                <input type="text" name="name" placeholder="例)山田　太郎">
            </div>
            <div class="form-email">
                <span>メールアドレス</span>
                <input type="email" name="email" placeholder="例)test@example.com">
            </div>
            <div class="form-password">
                <span>パスワード</span>
                <input type="password" name="password" placebolder="例)coachtech1106">
            </div>
            <button type="submit" class="form-button">登録</button>
        </form>
    </div>
</div>
@endsection