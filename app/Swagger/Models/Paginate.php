<?php

namespace App\Swagger\Models;

use OpenApi\Attributes\Items;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;

#[Schema(title: 'Pagination', description: 'Модель пагинации', type: 'object')]
class Paginate
{
    #[Property(
        property: 'links',
        description: 'Ссылки для пагинации',
        properties: [
            new Property(
                property: 'first',
                type: 'string'
            ),
            new Property(
                property: 'last',
                type: 'string'
            ),
            new Property(
                property: 'prev',
                type: 'string'
            ),
            new Property(
                property: 'next',
                type: 'string'
            ),
        ],
        type: 'object',
    )]
    public $links;

    #[Property(
        property: 'meta',
        description: 'Мета информация',
        properties: [
            new Property(
                property: 'current_page',
                type: 'int'
            ),
            new Property(
                property: 'from',
                type: 'int'
            ),
            new Property(
                property: 'last_page',
                type: 'int'
            ),
            new Property(
                property: 'path',
                type: 'string'
            ),
            new Property(
                property: 'per_page',
                type: 'int'
            ),
            new Property(
                property: 'to',
                type: 'int'
            ),
            new Property(
                property: 'total',
                type: 'int'
            ),
            new Property(
                property: 'links',
                type: 'array',
                items: new Items(
                    properties: [
                        new Property(
                            property: 'url',
                            type: 'string'
                        ),
                        new Property(
                            property: 'label',
                            type: 'string'
                        ),
                        new Property(
                            property: 'active',
                            type: 'boolean'
                        ),
                    ],
                    type: 'object'
                )
            )
        ],
        type: 'object',
    )]
    public $meta;
}
