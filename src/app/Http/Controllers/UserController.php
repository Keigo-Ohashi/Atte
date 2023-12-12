<?php

namespace App\Http\Controllers;

use App\Services\User\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    // ユーザー一覧
    public function showUserList()
    {
        $userList = $this->userService->getUserList(5);

        // ユーザー一覧ページを表示
        return view('/user/index', compact('userList'));
    }

    // ユーザー別勤怠表
    public function showAttendanceList($id)
    {
        $user = $this->userService->getUser($id);
        $attendanceList = $this->userService->getAttendanceList($id, 5);

        return view('/user/attendance', compact('user', 'attendanceList'));
    }
}
