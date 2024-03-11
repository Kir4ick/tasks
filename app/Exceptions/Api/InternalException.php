<?php

namespace App\Exceptions\Api;

use App\Exceptions\Api\Abstracts\AbstractApiException;
use Symfony\Component\HttpFoundation\Response;

class InternalException extends AbstractApiException
{
    protected function getHTTPStatusCode(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    public function __construct(string $message = 'Внутренняя ошибка сервера')
    {
        parent::__construct($message);
    }
}
