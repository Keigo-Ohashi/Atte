<?php

namespace App\Services\User;

use Illuminate\Pagination\LengthAwarePaginator;

interface UserService
{
    // ユーザーリストを取得
    public function getUserList(int $perPage): LengthAwarePaginator;
}
