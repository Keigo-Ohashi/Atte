<?php

namespace App\Services;

use App\Repositories\AttendanceRepository;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceService
{
    private $attendanceRepository;

    public function __construct()
    {
        $this->attendanceRepository = new AttendanceRepository;
    }

    // 勤務状態をセッションに保存
    public function getAttendanceState(int $userId): array
    {
        // 現在の勤務レコードを取得
        $currentAttendance = $this->attendanceRepository->findCurrentAttendance($userId);

        // 勤務レコードのあるか
        if (is_null($currentAttendance)) {

            // 勤務レコードなし->勤務外
            return [
                'isWorking' => false,
                'isBreaking' => false
            ];
        } else {

            // 勤務レコードあり->勤務中
            return [
                'isWorking' => true,
                'isBreaking' => !is_null($currentAttendance->started_break_at),
                'attendanceId' => $currentAttendance->id
            ];
        }
    }

    // 出勤
    public function clockIn(int $userId): void
    {
        $this->attendanceRepository->clockIn($userId, Carbon::now());
    }

    // 退勤
    public function clockOut(int $attendanceId): void
    {
        $this->attendanceRepository->clockOut($attendanceId, Carbon::now());
    }

    // 休憩開始
    public function breakBegin(int $attendanceId): void
    {
        $this->attendanceRepository->breakBegin($attendanceId, Carbon::now());
    }

    // 休憩終了
    public function breakEnd(int $attendanceId): void
    {
        $this->attendanceRepository->breakEnd($attendanceId, Carbon::now());
    }

    // 勤務リストを取得
    public function getAttendanceList(String $date): LengthAwarePaginator
    {
        return $this->attendanceRepository->getAttendanceListOfDay($date);
    }
}
