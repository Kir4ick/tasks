<?php

namespace App\Swagger\Models\Tasks\Responses;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: 'TaskResponse', description: 'Модель response для вывода задачи', type: 'object')]
class Task
{
    #[Property(property: 'id', type: 'string', format: 'uuid')]
    public $id;

    #[Property(property: 'title', type: 'string')]
    public $title;

    #[Property(property: 'status', type: 'string', enum: ['create', 'await', 'processed', 'done'])]
    public $status;

    #[Property(property: 'created_by', type: 'string', format: 'uuid')]
    public $created_by;

    #[Property(property: 'created_at', type: 'string', format: 'datetime')]
    public $created_at;

    #[Property(property: 'updated_at', type: 'string', format: 'datetime')]
    public $updated_at;
}
