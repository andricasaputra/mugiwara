<?php

namespace App\Http\Pipelines\QueryFilters;

class Search extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->where('name', 'like' , '%' . request($this->filterName()) .'%');
    }
}
