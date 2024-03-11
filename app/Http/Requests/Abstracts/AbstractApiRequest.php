<?php

namespace App\Http\Requests\Abstracts;

use App\Exceptions\Api\UnauthorizedException;
use App\Exceptions\Api\ValidationFailedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AbstractApiRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new ValidationFailedException($validator->getMessageBag());
    }

    protected function failedAuthorization()
    {
        throw new UnauthorizedException();
    }
}
