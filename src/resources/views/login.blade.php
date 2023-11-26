@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('title')
  <title>ログイン</title>
@endsection

@section('main')
  <div class="inner-main">

    <div class="main-title">
      <div class="inner-main-title">
        ログイン
      </div>
    </div>

    <form class="login-form" method="post" action="login">
      @csrf

      @if (count($errors) > 0)
        <div class="error">
          メールアドレスまたはパスワードが違います
        </div>
      @endif

      <div class="input-text">
        <input type="text" name="email" placeholder="メールアドレス" value="{{ old('email') }}">
      </div>

      <div class="input-text">
        <input type="password" name="password" placeholder="パスワード" value="{{ old('password') }}">
      </div>

      <div class="submit-button">
        <button type="submit">ログイン</button>
      </div>

    </form>

    <div class="register-guidance">
      <p>アカウントをお持ちでない方はこちらから</p>
      <p><a href="register">会員登録</a></p>
    </div>

  </div>
@endsection
