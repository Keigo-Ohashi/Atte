<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository
{
    // ユーザーリストを取得
    public function getUserList(int $perPage): LengthAwarePaginator;
}
