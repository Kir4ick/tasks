<?php

namespace App\Exceptions\Api;

use App\Exceptions\Api\Abstracts\AbstractApiException;
use Illuminate\Http\Response;

class AccessDeniedException extends AbstractApiException
{

    protected function getHTTPStatusCode(): int
    {
        return Response::HTTP_FORBIDDEN;
    }

    public function __construct(string $message = 'Доступ запрещён')
    {
        parent::__construct($message);
    }
}
