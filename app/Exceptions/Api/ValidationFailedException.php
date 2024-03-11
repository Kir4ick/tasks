<?php

namespace App\Exceptions\Api;

use App\Exceptions\Api\Abstracts\AbstractApiException;
use Illuminate\Http\Response;
use Illuminate\Support\MessageBag;

class ValidationFailedException extends AbstractApiException
{

    protected function getHTTPStatusCode(): int
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }

    public function __construct(MessageBag $messages, string $message = 'Ошибка валидации')
    {
        $response['message'] = __($message);
        $response['code'] = $this->getHTTPStatusCode();
        $response['status'] = false;
        $response['validations'] = $messages->getMessages();

        $this->response = response()->json($response, $this->getHTTPStatusCode());
    }
}
