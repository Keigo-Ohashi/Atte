@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title')
  <title>ホーム</title>
@endsection

@section('main')
  <div class="main-title">
    <div class="inner-main-title">
      {{ Auth::user()->name }}さんお疲れ様です！
    </div>
  </div>

  <div class="stamp-table">

    <div class="stamp-row">

      <form class="stamp-form" action="/clock-in" method="post">
        @csrf
        <button class="stamp-button" type="submit" @if ($status['isWorking']) disabled @endif>勤務開始</button>
      </form>

      <form class="stamp-form" action="/clock-out" method="post">
        @csrf
        @method('patch')
        <button class="stamp-button" type="submit" @if (!$status['isWorking']) disabled @endif>勤務終了</button>
      </form>

    </div>

    <div class="stamp-row">

      <form class="stamp-form" action="/break-begin" method="post">
        @csrf
        @method('patch')
        <button class="stamp-button" type="submit" @if (!$status['isWorking'] or $status['isBreaking']) disabled @endif>休憩開始</button>
      </form>

      <form class="stamp-form" action="/break-end" method="post">
        @csrf
        @method('patch')
        <button class="stamp-button" type="submit" @if (!$status['isWorking'] or !$status['isBreaking']) disabled @endif>休憩終了</button>
      </form>

    </div>
  @endsection
