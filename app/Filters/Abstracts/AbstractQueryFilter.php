<?php

namespace App\Filters\Abstracts;

use App\Filters\Contracts\IQueryFilter;
use Illuminate\Database\Eloquent\Builder;

abstract class AbstractQueryFilter implements IQueryFilter
{
    public function filter(Builder $query, array $filter_data): Builder
    {
        $callbacks = $this->getCallbacks();

        foreach ($filter_data as $key => $value) {
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
