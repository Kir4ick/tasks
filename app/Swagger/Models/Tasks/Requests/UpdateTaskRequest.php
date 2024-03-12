<?php

namespace App\Swagger\Models\Tasks\Requests;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: 'UpdateTaskRequest', description: 'Модель request для создания задачи', type: 'object')]
class UpdateTaskRequest
{
    #[Property(property: 'title', type: 'string')]
    public $title;

    #[Property(property: 'status', type: 'string', enum: ['create', 'await', 'processed', 'done'])]
    public $status;
}
