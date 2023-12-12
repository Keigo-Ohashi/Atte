@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/user/attendance.css') }}">
@endsection

@section('title')
  <title>勤怠一覧</title>
@endsection

@section('main')
  <div class="title">

    <div class="name">
      {{ $user->name }}
    </div>

  </div>

  <div class="attendance-table">

    <div class="attendance-row">

      <div class="attendance-cell head">
        <div class="inner-cell">勤務日</div>
      </div>

      <div class="attendance-cell head">
        <div class="inner-cell">勤務開始</div>
      </div>

      <div class="attendance-cell head">
        <div class="inner-cell">勤務終了</div>
      </div>

      <div class="attendance-cell head">
        <div class="inner-cell">休憩時間</div>
      </div>

      <div class="attendance-cell head">
        <div class="inner-cell">勤務時間</div>
      </div>

    </div>


    @foreach ($attendanceList as $attendance)
      <div class="attendance-row">

        <div class="attendance-cell">
          <div class="inner-cell">{{ $attendance['date'] }}</div>
        </div>

        <div class="attendance-cell">
          <div class="inner-cell">{{ $attendance['clocked_in_at_str'] }}</div>
        </div>

        <div class="attendance-cell">
          <div class="inner-cell">{{ $attendance['clocked_out_at_str'] }}</div>
        </div>

        <div class="attendance-cell">
          <div class="inner-cell">{{ $attendance['break_time_str'] }}</div>
        </div>

        <div class="attendance-cell">
          <div class="inner-cell">{{ $attendance['work_time_str'] }}</div>
        </div>

      </div>
    @endforeach

  </div>

  <div class="page-links">
    <div class="inner-page-links">
      {{ $attendanceList->links() }}
    </div>
  </div>
@endsection
