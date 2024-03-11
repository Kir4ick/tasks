<?php

namespace App\Exceptions\Api;

use App\Exceptions\Api\Abstracts\AbstractApiException;
use Illuminate\Http\Response;

class NotFoundException extends AbstractApiException
{
    protected function getHTTPStatusCode(): int
    {
        return Response::HTTP_NOT_FOUND;
    }

    public function __construct(string $message = 'Не найдено')
    {
        parent::__construct($message);
    }
}
