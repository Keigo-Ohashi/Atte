<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Repositories\Attendance\AttendanceRepository;

class ChangeAttendanceCommand extends Command
{
    private $attendanceRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:change-attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '勤怠切替';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(AttendanceRepository $attendanceRepository)
    {
        parent::__construct();
        $this->attendanceRepository = $attendanceRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        // 勤務中の全レコードを取得
        $attendanceList = $this->attendanceRepository->getPreviousDayAttendanceAllOnWork();

        // 取得したレコードごとに実行
        foreach ($attendanceList as $attendance) {

            // 退勤処理
            $this->attendanceRepository->clockOut($attendance['id'], Carbon::today());

            // 出勤処理
            if (is_null($attendance->started_break_at)) {
                // 休憩中ではない場合
                $this->attendanceRepository->clockIn($attendance['user_id'], Carbon::today());
            } else {
                //休憩中の場合
                $this->attendanceRepository->clockInOnBreak($attendance['user_id'], Carbon::today());
            }
        }

        return $attendanceList->count();
    }
}
