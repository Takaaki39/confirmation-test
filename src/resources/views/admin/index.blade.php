@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
@endsection

@section('header_button')
    <form class="header-btn" action="/logout" method="post">
        @csrf
        <button class="header-logout" type="submit">logout</button>
    </form>
@endsection

@section('contents')
<div class="admin">
    <div class="admin-heading">
        <a href="/admin">Admin</a>
    </div>
    <div class="search">
        <form class="search-form" action="/admin/search" method="post">
            <input name="input" type="text" placeholder="名前やメールアドレスを入力してください">
            <select name="gender">
                <option value="0">選択してください</option>
                <option value="1">男性</option>
                <option value="2">女性</option>
                <option value="3">その他</option>
            </select>
            <select name="category_id">
                <option>お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->content}}</option>
                @endforeach
            </select>
            <input name="date" type="date">
            <button type="submit">検索</button>
        </form>
        <form class="reset-form" action="/reset" method="post">
            <button type="submit">リセット</button>
        </form>
    </div>

    <div class="page">
        <a href="/admin/export" class="export-btn">エクスポート</a>
        <!-- {{$contacts->links();}} -->
    </div>

    <div class="contacts">
        <table class="contact-table__inner">
            <tr class="contact-table__header-row">
                <th>お名前</th>
                <th>性別</th>
                <th>メールアドレス</th>
                <th>お問い合わせの種類</th>
                <th></th>
            </tr>
            @foreach($contacts as $contact)
            <tr class="contact-table__row font-color">
                <td>{{$contact->last_name." ".$contact->first_name}}</td>
                <td>{{$contact->gender}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->category->content}}</td>
                <td><a href="*" class="detail-btn">詳細</a></td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection