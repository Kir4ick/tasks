<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Abstracts\AbstractApiRequest;

class ListRequest extends AbstractApiRequest
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
            'updated' => 'in:asc,desc',
            'status' => 'in:create,await,processed,done',
            'created' => 'in:asc,desc',
            'columns' => 'array',
            'columns.*' => 'string',
            'my' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'title.string' => __('Поле должно быть текстового формата'),
            'title.min' => __('Слишком короткое название'),
            'title.max' => __('Слишком длинное название'),

            'updated.in' => __('Поле должно быть asc или desc значения'),
            'created.in' => __('Поле должно быть asc или desc значения'),

            'status.in' => __('Неправильный тип статуса'),

            'columns.array' => __('Поле должно быть формата массива'),
            'columns.*.string' => __('Элементы массива должны быть строчные'),
            'my.boolean' => __('Поле должно быть boolean формата')
        ];
    }
}
