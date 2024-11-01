<?php

namespace App\Domains\User\Services;

use App\Domains\User\Entities\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Domains\User\Repositories\UserRepository;
use Illuminate\Validation\ValidationException;

class UserService {
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $data): User
    {
        $validatedData = $this->validateRegistrationData($data);

        $userEntity = new User(
            0,
            $validatedData['name'],
            $validatedData['email'],
            $validatedData['password'],
        );
 
        return $this->userRepository->create($userEntity);
    }

    public function loginUser(array $data): User
    {
        $credentials = $this->validateLoginData($data);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid email or password'],
            ]);
        }

        $user = $this->userRepository->findByEmail(Auth::user()->email);
        $user->setToken($this->userRepository->getToken(Auth::user()));

        return $user;
    }

    public function logoutUser(Request $request): void
    {
        $request->user()->tokens()->delete();
    }

    private function validateRegistrationData(array $data): array
    {
        return validator($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ])->validate();
    }

    private function validateLoginData(array $data): array
    {
        return validator($data, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ])->validate();
    }
}