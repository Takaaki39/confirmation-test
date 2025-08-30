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
              <input class="form__input--last-name" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}"/>
              <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}"/>
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
            <div class="form__input--text-radio">
                <label class="font-color">
                  @if(empty(old('gender')) || old('gender') == 1)
                  <input type="radio" id="men" name="gender" value="1" checked>
                  @else
                  <input type="radio" id="men" name="gender" value="1">
                  @endif
                  男性
                </label>
                <label class="font-color">
                  @if(old('gender') == 2)
                  <input type="radio" id="women" name="gender" value="2" checked>
                  @else
                  <input type="radio" id="women" name="gender" value="2">
                  @endif
                  女性
                </label>
                <label class="font-color">
                  @if(old('gender') == 3)
                  <input type="radio" id="other" name="gender" value="3" checked>
                  @else
                  <input type="radio" id="other" name="gender" value="3">
                  @endif
                  その他
                </label>
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
              <input type="email" name="email" placeholder="例: test@example.com" value="{{ old('email') }}"/>
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
            <div class="form__input--text-tel">
                <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}">
                <span class="form__input--text-span">-</span>
                <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}">
                <span class="form__input--text-span">-</span>
                <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
            </div>
            <div class="form__error">
              @error('tel1')
                {{$errors->first('tel1')}}
                @else
                @error('tel2')
                  {{$errors->first('tel2')}}
                  @else
                    @error('tel3')
                      {{$errors->first('tel3')}}
                    @enderror
                @enderror
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
              <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
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
              <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
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
                <select class="form__input--text-select" name="category_id">
                    <option>選択してください</option>
                    @foreach($categories as $category)
                      @if(old('category_id') == $category->id)  
                        <option value="{{$category->id}}" selected>{{$category->content}}</option>
                      @else
                        <option value="{{$category->id}}">{{$category->content}}</option>
                      @endif
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
              <textarea name="detail" placeholder="資料をいただきたいです"> {{ old('detail') }}</textarea>
            </div>
            <div class="form__error">
              @error('detail')
                {{$errors->first('detail')}}
              @enderror
            </div>
          </div>
        </div>
        <div class="form__button">
          <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection