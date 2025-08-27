@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{asset('css/contact.css')}}">
@endsection

@section('contents')
<div class="contact-form">
    <div class="contact-form__heading">
        <span class="font-color">Contact</span>
    </div>
    <form class="form" action="/confirm" method="post">
        @csrf
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item font-color">お名前</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="last_name" placeholder="例）山田" value="山田"/>
              <input type="text" name="first_name" placeholder="例）太郎" value="太郎"/>
            </div>
            <div class="form__error">
              @error('last_name')
                {{$errors->first('last_name')}}
              @enderror
              @error('first_name')
                {{$errors->first('first_name')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item font-color">性別</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
                <input type="radio" id="men" name="gender" value="1" checked>
                  <label for="men">男性</label>
                <input type="radio" id="women" name="gender" value="2">
                  <label for="women">女性</label>
                <input type="radio" id="other" name="gender" value="3">
                  <label for="other">その他</label>
            </div>
            <div class="form__error">
              @error('gender')
                {{$errors->first('gender')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item font-color">メールアドレス</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="email" name="email" placeholder="test@example.com" value="test@example.com"/>
            </div>
            <div class="form__error">
              @error('email')
                {{$errors->first('email')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item font-color">電話番号</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
                <input type="text" name="tel1" placeholder="080" value="000">
                <span>-</span>
                <input type="text" name="tel2" placeholder="1234" value="1111">
                <span>-</span>
                <input type="text" name="tel3" placeholder="5678" value="2222">
            </div>
            <div class="form__error">
              @error('tel1')
                {{$errors->first('tel1')}}
              @enderror
              @error('tel2')
                {{$errors->first('tel2')}}
              @enderror
              @error('tel3')
                {{$errors->first('tel3')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item font-color">住所</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="東京都渋谷区千駄ヶ谷1-2-3">
            </div>
            <div class="form__error">
              @error('address')
                {{$errors->first('address')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item font-color">建物名</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
              <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="千駄ヶ谷マンション101">
            </div>
            <div class="form__error">
              @error('building')
                {{$errors->first('building')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item font-color">お問い合わせの種類</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--text">
                <select name="category_id">
                    <option>選択してください</option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->content}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form__error">
              @error('category_id')
                {{$errors->first('category_id')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__group">
          <div class="form__group-title">
            <span class="form__label--item font-color">お問い合わせ内容</span>
            <span class="form__label--required">※</span>
          </div>
          <div class="form__group-content">
            <div class="form__input--textarea">
              <textarea name="detail" placeholder="資料をいただきたいです">資料をいただきたいです</textarea>
            </div>
            <div class="form__error">
              @error('detail')
                {{$errors->first('detail')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">送信</button>
        </div>
    </form>
</div>
@endsection