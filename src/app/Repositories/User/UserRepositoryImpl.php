<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepositoryImpl implements UserRepository
{
    // ユーザーリストを取得
    public function getUserList(int $perPage): LengthAwarePaginator
    {
        return User::Paginate($perPage);
    }
}
