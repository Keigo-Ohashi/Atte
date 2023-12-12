<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserService
{

    // ユーザー情報を取得
    public function getUser(int $id): User;

    // ユーザーリストを取得
    public function getUserList(int $perPage): LengthAwarePaginator;

    // ユーザー別勤怠リストを取得
    public function getAttendanceList(int $id, int $perPage): LengthAwarePaginator;
}
