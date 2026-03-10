<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Throwable;

class AuthService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        try {

            DB::beginTransaction();
            $data['password'] = Hash::make($data['password']);
            $user = $this->userRepository->create($data);
            event(new Registered($user));
            DB::commit();
            return $user;
            
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error('Register error', [
                'message' => $e->getMessage()
            ]);
            return false;
        }
    }
}