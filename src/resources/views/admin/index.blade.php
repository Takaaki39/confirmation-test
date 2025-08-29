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
        <form class="search-form" action="/admin/search" method="get">
            @csrf
            <input class="search-form__input text-setting" name="input" type="text" placeholder="名前やメールアドレスを入力してください" value="{{request('input')}}">
            <select class="search-form__gender text-setting appearance" name="gender">
                <option value="0">性別</option>
                <option value="1" {{request('gender') == 1 ? 'selected' : ''}}>男性</option>
                <option value="2" {{request('gender') == 2 ? 'selected' : ''}}>女性</option>
                <option value="3" {{request('gender') == 3 ? 'selected' : ''}}>その他</option>
            </select>
            <select class="search-form__category text-setting appearance" name="category_id">
                <option value="0">お問い合わせの種類</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" {{request('category_id') == $category->id ? 'selected' : ''}}>{{$category->content}}</option>
                @endforeach
            </select>
            <input class="search-form__date text-setting appearance" name="search_date" type="date" value="{{request('search_date')}}">
            <button class="search-button" type="submit">検索</button>
        </form>
        <form class="reset-form" action="/admin" method="get">
            @csrf
            <button class="reset-button" type="submit">リセット</button>
        </form>
    </div>

    <div class="page">
        <a href="{{route('admin.export', request()->all()) }}" class="export-btn">エクスポート</a>
        {{$contacts->links('vendor.pagination.tailwind2');}}
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
                @if($contact->isJapaneseName($contact->last_name) == true)
                    <td>{{$contact->last_name." ".$contact->first_name}}</td>
                @else
                    <td>{{$contact->first_name." ".$contact->last_name}}</td>
                @endif
                <td>{{$contact->genderLabel()}}</td>
                <td>{{$contact->email}}</td>
                <td>{{$contact->category->content}}</td>
                <td>
                    <label for="modalToggle{{$contact->id}}" class="detail-btn">詳細</label>
                    <input type="checkbox" id="modalToggle{{$contact->id}}" class="modal-checkbox">
                    <div class="modal" id="modal">
                        <div class="modal-wrapper">
                            <label for="modalToggle{{$contact->id}}" class="close">&times;</label>
                            <div class="modal-content">
                                <h1>お名前</h1>
                                @if($contact->isJapaneseName($contact->last_name) == true)
                                    <p>{{$contact->last_name." ".$contact->first_name}}</p>
                                @else
                                    <p>{{$contact->first_name." ".$contact->last_name}}</p>
                                @endif
                            </div>
                            <div class="modal-content">
                                <h1>性別</h1>
                                <p>{{$contact->genderLabel()}}</p>
                            </div>
                            <div class="modal-content">
                                <h1>メールアドレス</h1>
                                <p>{{$contact->email}}</p>
                            </div>
                            <div class="modal-content">
                                <h1>電話番号</h1>
                                <p>{{$contact->tel}}</p>
                            </div>
                            <div class="modal-content">
                                <h1>住所</h1>
                                <p>{{$contact->address}}</p>
                            </div>
                            <div class="modal-content">
                                <h1>建物名</h1>
                                <p>{{$contact->building}}</p>
                            </div>
                            <div class="modal-content">
                                <h1>お問い合わせの種類</h1>
                                <p>{{$contact->category->content}}</p>
                            </div>
                            <div class="modal-content">
                                <h1>お問い合わせ内容</h1>
                                <p>{{$contact->detail}}</p>
                            </div>

                            <div class="delete-button">
                                <form action="/admin/delete" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id" value="{{$contact->id}}">
                                    <button>削除</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection