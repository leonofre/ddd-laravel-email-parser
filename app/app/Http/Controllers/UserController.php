<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domains\User\Services\UserService;

class UserController extends Controller {
    private UserService $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function register(Request $request) {
        $user = $this->userService->registerUser([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);
        
        return response()->json([
            'access_token' => $user->getToken(),
            'token_type' => 'Bearer',
        ]);
    }

    public function login(Request $request) {
        $user = $this->userService->loginUser([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        

        return response()->json([
            'access_token' => $user->getToken(),
            'token_type' => 'Bearer',
        ]);
    }

    public function logout(Request $request) {
        $this->userService->logoutUser($request);

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}