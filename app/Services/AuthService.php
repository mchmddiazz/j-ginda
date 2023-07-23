<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class AuthService extends \Iqbalatma\LaravelServiceRepo\BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }


    /**
     * @param array $credentials
     * @return true[]
     * @throws AuthenticationException
     */
    public function authenticate(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            return [
                "success" => false,
                "message" => "Email atau password salah"
            ];
        }

        return [
            "success" => true
        ];
    }
}