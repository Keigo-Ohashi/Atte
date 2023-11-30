@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('title')
  <title>日付一覧</title>
@endsection

@section('main')
  <div class="date">
    <div class="inner-date">

      <a class="date-link" href="/attendance/{{ $previousDate }}">
        <div>&lt</div>
      </a>

      <div class="today">
        {{ $date }}
      </div>

      <a class="date-link" href="/attendance/{{ $nextDate }}">
        <div>&gt</div>
      </a>

    </div>
  </div>

  <div class="attendance-table">

    <div class="attendance-row">

      <div class="attendance-cell head left">
        <div class="inner-cell">名前</div>
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

        <div class="attendance-cell left">
          <div class="inner-cell">{{ $attendance['name'] }}</div>
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
