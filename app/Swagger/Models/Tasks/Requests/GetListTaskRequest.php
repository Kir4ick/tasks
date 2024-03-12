<?php

namespace App\Swagger\Models\Tasks\Requests;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\OpenApi;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: 'ListTaskRequest', description: 'Модель request для списка задач', type: 'object')]
class GetListTaskRequest
{
    #[Property(
        property: 'title',
        description: 'Фильтр по названию задачи',
        type: 'string',
    )]
    public $title;

    #[Property(
        property: 'updated',
        description: 'Сортировка по дате обновления',
        type: 'string',
        enum: ['asc', 'desc'],
    )]
    public $updated;

    #[Property(
        property: 'status',
        description: 'Фильтр по статусу',
        type: 'string',
        enum: ['create', 'await', 'processed', 'done'],
    )]
    public $status;

    #[Property(
        property: 'created',
        description: 'Сортировка по дате создания',
        type: 'string',
        enum: ['asc', 'desc']
    )]
    public $created;

    #[Property(
        property: 'my',
        description: 'Вывод только задач авторизированного пользователя',
        type: 'boolean'
    )]
    public $my;

    #[Property(
        property: 'columns',
        description: 'Список выводимих колонок',
        type: 'array',
        items: new Items(type: 'string')
    )]
    public $columns;
}
