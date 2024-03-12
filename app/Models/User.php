<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Модель заглушка для авторизации
 *
 * @property string|null $uuid (uuid)
 */
class User extends Authenticatable implements \Illuminate\Contracts\Auth\Authenticatable, JWTSubject
{
    use HasFactory;

    private ?string $uuid;

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getAuthIdentifierName()
    {
        return 'uuid';
    }

    public function getAuthIdentifier()
    {
        return $this->uuid;
    }

    public function getAuthPassword()
    {
        return null;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value) {}

    public function getRememberTokenName() {}

    public function getJWTIdentifier()
    {
        return $this->uuid;
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
