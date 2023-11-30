<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Attendance\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    private $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    // ホーム
    public function home(): View
    {
        // 現在の勤務状態を取得
        $status = $this->attendanceService->getAttendanceState(Auth::id());

        // 勤務状態をフラッシュデータに保存し、ホームを表示
        return view('home', compact('status'));
    }

    // 出勤打刻
    public function clockIn(): RedirectResponse
    {
        // 現在の勤務状態を取得
        $status = $this->attendanceService->getAttendanceState(Auth::id());

        // 勤務中でないなら出勤打刻を実行
        if (!$status['isWorking']) {
            $this->attendanceService->clockIn(Auth::id());
        }

        // ホームにリダイレクト
        return redirect('/');
    }

    // 退勤打刻
    public function clockOut(): RedirectResponse
    {
        // 現在の勤務状態を取得
        $status = $this->attendanceService->getAttendanceState(Auth::id());

        // 勤務中なら退勤打刻を実行
        if ($status['isWorking']) {
            $this->attendanceService->clockOut($status['attendanceId'], $status['isBreaking']);
        }
        // ホームにリダイレクト
        return redirect('/');
    }

    // 休憩開始打刻
    public function breakBegin(): RedirectResponse
    {
        // 現在の勤務状態を取得
        $status = $this->attendanceService->getAttendanceState(Auth::id());

        // 勤務中かつ休憩中でないなら休憩開始打刻を実行
        if ($status['isWorking'] and !$status['isBreaking']) {
            $this->attendanceService->breakBegin($status['attendanceId']);
        }

        // ホームにリダイレクト
        return redirect('/');
    }

    // 休憩終了打刻
    public function breakEnd(): RedirectResponse
    {
        // 現在の勤務状態を取得
        $status = $this->attendanceService->getAttendanceState(Auth::id());

        // 勤務中かつ休憩中なら休憩終了打刻を実行
        if ($status['isWorking'] and $status['isBreaking']) {
            $this->attendanceService->breakEnd($status['attendanceId']);
        }

        // ホームにリダイレクト
        return redirect('/');
    }

    // 日ごとの勤務リスト
    public function showAttendanceList($date = 'today'): View
    {
        // 日付を設定
        if ($date == 'today') {
            $date = Carbon::today();
        } else {
            $date = (new Carbon($date));
        }

        $previousDate = $date->copy()->subDay()->toDateString();
        $nextDate = $date->copy()->addDay()->toDateString();
        $date = $date->toDateString();

        // 勤務リストを取得
        $attendanceList = $this->attendanceService->getAttendanceList($date, 5);

        // 勤務リストページを表示
        return view('attendance', compact('previousDate', 'date', 'nextDate', 'attendanceList'));
    }

}
