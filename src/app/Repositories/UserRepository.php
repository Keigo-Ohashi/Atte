<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    // ユーザーリストを取得
    public function findAll(): Collection
    {
        return User::all();
    }
}
