<?php

namespace App\Swagger\Models\Tasks\Requests;

use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: 'CreateTaskRequest', description: 'Модель request для создания задачи', type: 'object')]
class CreateTaskRequest
{
    #[Property(property: 'title', type: 'string')]
    public $title;
}
