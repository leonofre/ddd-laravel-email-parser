<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domains\User\Entities\User as UserEntity;

use App\Domains\User\Repositories\UserRepositoryInterface;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function create(UserEntity $userEntity): UserEntity
    {
        // Cria um novo usuário utilizando Eloquent e mapeia os dados da entidade
        $user = UserModel::create([
            'name' => $userEntity->getName(),
            'email' => $userEntity->getEmail(),
            'password' => Hash::make($userEntity->getPassword()),
        ]);

        // Cria o token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Atribui o token à entidade
        $userEntity->setToken($token);
        $userEntity->setId($user->id);

        // Retorna a entidade mapeada com os dados do Eloquent
        return $userEntity;
    }

    public function findById(int $id): ?UserEntity
    {
        $user = UserModel::find($id);

        if (!$user) {
            return null;
        }

        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            $user->password
        );
    }

    public function findByEmail(string $email): ?UserEntity
    {
        $user = UserModel::where('email', $email)->first();

        if (!$user) {
            return null;
        }

        return new UserEntity(
            $user->id,
            $user->name,
            $user->email,
            $user->password
        );
    }

    public function getToken(UserModel $user): string {
        return $user->createToken('auth_token')->plainTextToken;
    }
}
