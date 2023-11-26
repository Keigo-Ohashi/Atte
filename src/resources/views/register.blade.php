@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('title')
  <title>新規登録</title>
@endsection

@section('main')
  <div class="inner-main">

    <div class="main-title">
      <div class="inner-main-title">
        会員登録
      </div>
    </div>

    <form class="register-form" method="post" action="/register">
      @csrf

      <div class="input-text">

        <input type="text" name="name" placeholder="名前" value="{{ old('name') }}">
        @error('name')
          <div class="error">
            <div class="inner-error">
              {{ $errors->first('name') }}
            </div>
          </div>
        @enderror
      </div>

      <div class="input-text">
        <input type="email" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
        @error('email')
          <div class="error">
            {{ $errors->first('email') }}
          </div>
        @enderror
      </div>

      <div class="input-text">
        <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}">
        @error('password')
          <div class="error">
            {{ $errors->first('password') }}
          </div>
        @enderror
      </div>

      <div class="input-text">
        <input type="password" name="password_confirmation" placeholder="確認用パスワード" value="{{ old('password_confirmation') }}">
      </div>

      <div class="submit-button">
        <button type="submit">会員登録</button>
      </div>

    </form>

    <div class="login-guidance">
      <p>アカウントをお持ちの方はこちらから</p>
      <p><a href="login">ログイン</a></p>
    </div>

  </div>
@endsection
