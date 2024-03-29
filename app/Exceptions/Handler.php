<?php

namespace App\Exceptions;

use App\Exceptions\Api\Abstracts\AbstractApiException;
use App\Exceptions\Api\AccessDeniedException;
use App\Exceptions\Api\BadRequestException;
use App\Exceptions\Api\InternalException;
use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\UnauthorizedException;
use App\Exceptions\Api\ValidationFailedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        NotFoundException::class,
        AccessDeniedException::class,
        UnauthorizedException::class,
        ValidationFailedException::class,
        BadRequestException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            # Здесь представим, что подключение к какому-нибудь GrayLog
        });
    }

    /**
     * @inheritDoc
     */
    public function render($request, Throwable $e)
    {
        if (!$request->wantsJson()) {
            return parent::render($request, $e);
        }

        if (!($e instanceof AbstractApiException)) {
            $e = new InternalException();
        }

        return $e->getResponse();
    }
}
