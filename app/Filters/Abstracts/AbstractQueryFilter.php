<?php

namespace App\Filters\Abstracts;

use App\Filters\Contracts\IQueryFilter;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractQueryFilter implements IQueryFilter
{
    public const LIMIT = 'limit';

    public const PAGE = 'page';

    public const MY_RECORDS = 'my';

    public function filter(Builder $query, array $filterData): Builder
    {
        $callbacks = $this->getCallbacks();

        foreach ($filterData as $key => $value) {
            $callback = $callbacks[$key] ?? null;
            if ($callback == null) {
                continue;
            }

            $callback($query, $value);
        }

        return $query;
    }

    /**
     * Возвращает список callback
     * Callback должен получать Builder $query и mixed $value
     * А также ключи идентичны тем, что приходят в массиве
     *
     * @return array<string, \Closure>
     */
    abstract public function getCallbacks(): array;
}
