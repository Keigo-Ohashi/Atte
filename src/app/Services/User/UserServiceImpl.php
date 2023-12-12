<?php

namespace App\Services\User;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Repositories\Attendance\AttendanceRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserServiceImpl implements UserService
{
    private $userRepository;
    private $attendanceRepository;

    public function __construct(UserRepository $userRepository, AttendanceRepository $attendanceRepository)
    {
        $this->userRepository = $userRepository;
        $this->attendanceRepository = $attendanceRepository;
    }

    // ユーザー情報を取得
    public function getUser(int $id): User
    {
        return $this->userRepository->find($id);
    }

    // ユーザーリストを取得
    public function getUserList(int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->getUserList($perPage);
    }

    // ユーザー別勤怠リストを取得
    public function getAttendanceList(int $id, int $perPage): LengthAwarePaginator
    {
        return $this->attendanceRepository->getAttendanceList($id, $perPage);
    }
}
