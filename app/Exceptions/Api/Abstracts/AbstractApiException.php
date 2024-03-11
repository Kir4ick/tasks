<?php

namespace App\Exceptions\Api\Abstracts;

use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractApiException extends HttpResponseException
{
    public function __construct(string $message)
    {
        $response['message'] = __($message);
        $response['code'] = $this->getHTTPStatusCode();
        $response['status'] = false;

        if (config('app.debug')) {
            $response['trace'] = $this->getTrace();
        }

        parent::__construct(response()->json($response, $this->getHTTPStatusCode()));
    }

    /**
     * Возвращает http код ответа
     *
     * @return int
     */
    abstract protected function getHTTPStatusCode(): int;
}
