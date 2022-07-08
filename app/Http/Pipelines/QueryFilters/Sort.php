<?php

namespace App\Http\Pipelines\QueryFilters;

class Sort extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->orderBy('name', request($this->filterName()));
    }
}
