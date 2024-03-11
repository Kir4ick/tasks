<?php

namespace App\Http\Middleware;

use App\Exceptions\Api\UnauthorizedException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('index');
        }
    }

    /**
     * @inheritDoc
     */
    protected function unauthenticated($request, array $guards)
    {
        if (!$request->expectsJson()) {
            throw new AuthenticationException(
                'Unauthenticated.', $guards, $this->redirectTo($request)
            );
        }

        throw new UnauthorizedException();
    }
}
