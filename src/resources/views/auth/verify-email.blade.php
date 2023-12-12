@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/auth/verify-email.css') }}">
@endsection

@section('title')
  <title>アカウント登録受付完了</title>
@endsection

@section('main')
  <div class="title">
    アカウントの登録を受け付けました。
  </div>

  <div class="message">ご登録いただいた<span class="email">{{ Auth::user()->email }}</span>宛に登録確認用のご案内をお送りしましたので、<br>
    メールの内容を確認して、登録確認を完了してください。</div>

  <form class="logout-form" method="post" action="/logout">
    @csrf
    <button class="logout-button">ログイン</button>
  </form>
@endsection
