<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\AuthService;
use App\Http\Requests\AuthRequest\RegisterRequest;
use App\Http\Requests\AuthRequest\LoginRequest;

class AuthController extends Controller
{
    //
    public function __construct(
        private AuthService $authService
    ){}

    public function register(RegisterRequest $request)
    {
        $response = $this->authService->register($request->array());
        return $response;
    }

    public function login(LoginRequest $request)
    {
        $response = $this->authService->login($request->array());
        return $response;
    }

    public function logout(Request $request)
    {
        $response = $this->authService->logout($request->user());
        return $response;
    }


    public function user()
    {
        $response = $this->authService->user();
        return $response;
    }
}
