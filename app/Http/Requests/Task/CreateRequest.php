<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Abstracts\AbstractApiRequest;

/**
 * @property string $title
 */
class CreateRequest extends AbstractApiRequest
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
            'title' => 'string|min:4|max:256|required'
        ];
    }

    public function messages()
    {
        return [
            'title.string' => __('Поле должно быть текстового формата'),
            'title.min' => __('Слишком короткое название'),
            'title.max' => __('Слишком длинное название'),
            'title.required' => __('"Название" обязательно к заполнению')
        ];
    }
}
