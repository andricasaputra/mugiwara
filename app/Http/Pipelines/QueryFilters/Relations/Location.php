<?php

namespace App\Http\Pipelines\QueryFilters\Relations;

use App\Http\Pipelines\QueryFilters\Filter;

class Location extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder->whereHas('province', function($query){
            $query->where('name', 'like' , '%' . request($this->filterName()) .'%');
        });
    }
}
