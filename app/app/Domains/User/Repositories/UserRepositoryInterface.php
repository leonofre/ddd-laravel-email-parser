<?php

namespace App\Domains\User\Repositories;

use App\Domains\User\Entities\User;
use App\Models\User as UserModel;

interface UserRepositoryInterface {
    public function create(User $user): User;

    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function getToken(UserModel $user): string;
}
