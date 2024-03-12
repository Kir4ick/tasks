<?php

namespace App\Filters\Contracts;

use \Illuminate\Database\Eloquent\Builder;

interface IQueryFilter
{
    public function filter(Builder $query, array $filterData): Builder;
}
