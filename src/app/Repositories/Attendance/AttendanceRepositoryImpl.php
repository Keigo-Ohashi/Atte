<?php

namespace App\Repositories\Attendance;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AttendanceRepositoryImpl implements AttendanceRepository
{
    // 勤務中の記録を取得
    public function findCurrentAttendance(int $id): ?Attendance
    {
        return Attendance::where('user_id', $id)->whereDate('clocked_in_at', Carbon::today())->whereNull('clocked_out_at')->first();
    }

    // 出勤処理
    public function clockIn(int $userId, Carbon $datetime): void
    {
        Attendance::create([
            'user_id' => $userId,
            'clocked_in_at' => $datetime
        ]);
    }

    // 出勤処理(休憩中)
    public function clockInOnBreak(int $userId, Carbon $datetime): void
    {
        Attendance::create([
            'user_id' => $userId,
            'clocked_in_at' => $datetime,
            'started_break_at' => $datetime
        ]);
    }

    // 退勤処理
    public function clockOut(int $id, Carbon $datetime): void
    {
        // IDに一致する勤務レコードを取得
        $currentAttendance = Attendance::find($id);

        // 休憩中かどうか
        if (is_null($currentAttendance->started_break_at)) {
            // 休憩中でない場合
            Attendance::find($id)->update([
                'clocked_out_at' => $datetime
            ]);
        } else {
            // 休憩中の場合
            Attendance::find($id)->update([
                'clocked_out_at' => $datetime,
                'break_time' => $currentAttendance->break_time + (strtotime($datetime) - strtotime($currentAttendance->started_break_at)),
                'started_break_at' => null
            ]);
        }
    }

    // 休憩開始処理
    public function breakBegin(int $id, Carbon $datetime): void
    {
        Attendance::find($id)->update([
            'started_break_at' => $datetime
        ]);
    }

    // 休憩終了処理
    public function breakEnd(int $id, Carbon $datetime): void
    {
        $currentAttendance = Attendance::find($id);
        Attendance::find($id)->update([
            'break_time' => $currentAttendance->break_time + (strtotime($datetime) - strtotime($currentAttendance->started_break_at)),
            'started_break_at' =>  null
        ]);
    }

    // 特定の日の勤務記録を取得
    public function getAttendanceListOfDay(String $date, int $perPage): LengthAwarePaginator
    {
        return Attendance::whereDate('clocked_in_at', $date)->join('users', 'user_id', '=', 'users.id')->paginate($perPage);
    }

    // 全ユーザーの勤務中のレコードを取得
    public function getPreviousDayAttendanceAllOnWork(): Collection
    {
        return Attendance::whereDate('clocked_in_at', Carbon::yesterday())->whereNull('clocked_out_at')->get();
    }

    // 特定のユーザーの勤務リストを取得
    public function getAttendanceList($id, $perPage): LengthAwarePaginator
    {
        return Attendance::where('user_id', '=', $id)->join('users', 'user_id', '=', 'users.id')->orderBy('clocked_in_at', 'desc')->paginate($perPage);
    }
}
