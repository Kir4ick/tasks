<?php

namespace App\Http\Guards;

use App\Models\User;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Tymon\JWTAuth\JWT;

class JWTGuard implements Guard
{
    use GuardHelpers;

    public function user()
    {
        if ($this->user != null) {
            return $this->user;
        }

        # Смотрим, есть ли токен
        $token = $this->jwt->setRequest($this->request)->getToken();
        if ($token == null) {
            return null;
        }

        # Проверка на существование uuid в токене
        $userUUID = $this->jwt->payload()->get('user_uuid');
        if ($userUUID == null || !Uuid::isValid($userUUID)) {
            return null;
        }

        # Ставим пользователя заглушку
        $this->user = (new User())->setUuid($userUUID);

        return $this->user;
    }

    public function validate(array $credentials = []){}

    public function __construct(
        protected readonly JWT $jwt,
        protected readonly Request $request
    ){}
}
