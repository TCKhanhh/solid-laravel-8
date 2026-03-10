<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

class RegisterController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Đăng ký thất bại'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Người dùng đã đăng ký thành công!',
            'data' => $user
        ], 201);
    }
}