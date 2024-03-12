<?php

namespace App\Swagger\Models\Tasks\Responses;

use App\Swagger\Models\Paginate;
use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: 'ListTaskResponse', description: 'Модель response для списка задач', type: 'object')]
class ListTask extends Paginate
{

    #[Property(
        property: 'data',
        description: 'Список задач',
        type: 'array',
        items: new Items(
            ref: '#/components/schemas/Task'
        )
    )]
    public $data;

}
