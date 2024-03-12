<?php

namespace App\Filters\Traits;

use App\Filters\Abstracts\AbstractQueryFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Трейт для возможности фильтрации модели
 *
 * @method static Builder filter(AbstractQueryFilter $filter, array $filterData)
 */
trait Filterable
{
    public function scopeFilter(Builder $builder, AbstractQueryFilter $filter, array $filterData)
    {
        return $filter->filter($builder, $filterData);
    }
}
