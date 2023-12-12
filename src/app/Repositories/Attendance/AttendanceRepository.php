<?php

namespace App\Repositories\Attendance;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface AttendanceRepository
{
    // 勤務中の記録を取得
    public function findCurrentAttendance(int $id): ?Attendance;

    // 出勤処理
    public function clockIn(int $userId, Carbon $datetime): void;

    // 出勤処理(休憩中)
    public function clockInOnBreak(int $userId, Carbon $datetime): void;

    // 退勤処理
    public function clockOut(int $id, Carbon $datetime): void;

    // 休憩開始処理
    public function breakBegin(int $id, Carbon $datetime): void;

    // 休憩終了処理
    public function breakEnd(int $id, Carbon $datetime): void;

    // 特定の日の勤務リストを取得
    public function getAttendanceListOfDay(String $date, int $perPage): LengthAwarePaginator;

    // 全ユーザーの勤務中のレコードを取得
    public function getPreviousDayAttendanceAllOnWork(): Collection;

    // 特定のユーザーの勤務リストを取得
    public function getAttendanceList($id, $perPage): LengthAwarePaginator;
}
