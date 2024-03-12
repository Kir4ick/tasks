<?php

namespace App\Filters;

use App\Filters\Abstracts\AbstractQueryFilter;
use App\Filters\Contracts\IQueryFilter;
use \Illuminate\Database\Eloquent\Builder;

class TaskFilter extends AbstractQueryFilter
{

    public const STATUS_FIELD = 'status';

    public const CREATED_AT = 'created';

    public const UPDATED_AT = 'updated';

    public const TITLE_FIELD = 'title';

    public const CREATED_BY = 'created_by';

    public function getCallbacks(): array
    {
        return [
            self::STATUS_FIELD => [$this, 'searchByStatus'],
            self::CREATED_AT => [$this, 'sortByCreatedAt'],
            self::UPDATED_AT => [$this, 'sortByUpdatedAt'],
            self::TITLE_FIELD => [$this, 'searchByTitle'],
            self::CREATED_BY => [$this, 'searchCreatedBy']
        ];
    }

    public function searchByStatus(Builder $query, $value): Builder
    {
        return $query->where('status', '=', $value);
    }

    public function sortByCreatedAt(Builder $query, $value): Builder
    {
        return $query->orderBy('created_at', $value);
    }

    public function sortByUpdatedAt(Builder $query, $value): Builder
    {
        return $query->orderBy('updated_at', $value);
    }

    public function searchByTitle(Builder $query, $value): Builder
    {
        return $query->where('title', 'LIKE', $value);
    }

    public function searchCreatedBy(Builder $query, $value): Builder
    {
        return $query->where('created_by', '=', $value);
    }
}
