<?php

namespace App\Exceptions\Api;

use App\Exceptions\Api\Abstracts\AbstractApiException;
use Illuminate\Http\Response;

class BadRequestException extends AbstractApiException
{

    protected function getHTTPStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }

    public function __construct(string $message = 'Не правильно введены данные')
    {
        parent::__construct($message);
    }
}
