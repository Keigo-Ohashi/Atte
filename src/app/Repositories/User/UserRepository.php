<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository
{
    // ユーザー情報を取得
    public function find(int $id): User;

    // ユーザーリストを取得
    public function getUserList(int $perPage): LengthAwarePaginator;
}
