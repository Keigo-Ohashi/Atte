@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/user/index.css') }}">
@endsection

@section('title')
  <title>日付一覧</title>
@endsection

@section('main')
  <div class="title">
    会員一覧
  </div>

  <div class="user-table">

    <div class="user-row">

      <div class="user-cell head">
        <div class="inner-cell">名前</div>
      </div>

      <div class="user-cell head">
        <div class="inner-cell">メールアドレス</div>
      </div>

      <div class="user-cell head">
        <div class="inner-cell">認証ステータス</div>
      </div>

      <div class="user-cell head">
        <div class="inner-cell">登録日</div>
      </div>

    </div>


    @foreach ($userList as $user)
      <div class="user-row">

        <div class="user-cell">
          <div class="inner-cell"><a href="user/{{$user->id}}">{{ $user['name'] }}</a></div>
        </div>

        <div class="user-cell">
          <div class="inner-cell">{{ $user['email'] }}</div>
        </div>

        <div class="user-cell">
          <div class="inner-cell">
            @if ($user->hasVerifiedEmail())
            認証済み
            @else
            未認証
            @endif
          </div>
        </div>

        <div class="user-cell">
          <div class="inner-cell">{{ $user['registerDate'] }}</div>
        </div>

      </div>
    @endforeach

  </div>

  <div class="page-links">
    <div class="inner-page-links">
      {{ $userList->links() }}
    </div>
  </div>
@endsection
