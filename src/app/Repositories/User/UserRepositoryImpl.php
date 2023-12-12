<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepositoryImpl implements UserRepository
{

    // ユーザー情報を取得
    public function find(int $id): User
    {
        return User::find($id);
    }

    // ユーザーリストを取得
    public function getUserList(int $perPage): LengthAwarePaginator
    {
        return User::Paginate($perPage);
    }
}
