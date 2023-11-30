@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/user/index.css') }}">
@endsection

@section('title')
  <title>日付一覧</title>
@endsection

@section('main')
  <div class="title">
    ユーザー一覧
  </div>

  <div class="user-table">

    <div class="user-row">

      <div class="user-cell head left">
        <div class="inner-cell">名前</div>
      </div>

      <div class="user-cell head">
        <div class="inner-cell">メールアドレス</div>
      </div>

    </div>


    @foreach ($userList as $user)
      <div class="user-row">

        <div class="user-cell left">
          <div class="inner-cell">{{ $user['name'] }}</div>
        </div>

        <div class="user-cell">
          <div class="inner-cell">{{ $user['email'] }}</div>
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
