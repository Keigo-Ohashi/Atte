<?php

namespace App\Services\User;

use App\Repositories\User\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class UserServiceImpl implements UserService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // ユーザーリストを取得
    public function getUserList(int $perPage): LengthAwarePaginator
    {
        return $this->userRepository->getUserList($perPage);
    }
}
