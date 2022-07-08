<?php

namespace App\Http\Pipelines\QueryFilters\Relations;

use App\Http\Pipelines\QueryFilters\Filter;

class Status extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->whereHas('room', function($query){
            $query->where('status', request($this->filterName()));
        });
    }
}
