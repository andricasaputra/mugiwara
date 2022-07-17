<?php

namespace App\Http\Pipelines\QueryFilters;

class Status extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->where('status', request($this->filterName()));
    }
}
