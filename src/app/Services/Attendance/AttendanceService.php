<?php

namespace App\Services\Attendance;

use Illuminate\Pagination\LengthAwarePaginator;

interface AttendanceService
{
    // 勤務状態をセッションに保存
    public function getAttendanceState(int $userId): array;

    // 出勤
    public function clockIn(int $userId): void;

    // 退勤
    public function clockOut(int $attendanceId): void;

    // 休憩開始
    public function breakBegin(int $attendanceId): void;

    // 休憩終了
    public function breakEnd(int $attendanceId): void;

    // 勤務リストを取得
    public function getAttendanceList(String $date, int $perPage): LengthAwarePaginator;
}
