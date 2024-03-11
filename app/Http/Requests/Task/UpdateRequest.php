<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Abstracts\AbstractApiRequest;

/**
 * @property null|string $title
 * @property null|string $status
 */
class UpdateRequest extends AbstractApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, string>
     */
    public function rules()
    {
        return [
            'title' => 'string|min:4|max:256',
            'status' => 'in:create,await,processed,done'
        ];
    }

    public function messages()
    {
        return [
            'title.string' => __('Поле должно быть текстового формата'),
            'title.min' => __('Слишком короткое название'),
            'title.max' => __('Слишком длинное название'),
            'status.in' => __('Неправильный тип статуса')
        ];
    }
}
