<?php

namespace App\Exceptions\Api;

use App\Exceptions\Api\Abstracts\AbstractApiException;
use Illuminate\Http\Response;

class UnauthorizedException extends AbstractApiException
{

    protected function getHTTPStatusCode(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }

    public function __construct(string $message = 'Не авторизован')
    {
        parent::__construct($message);
    }
}
