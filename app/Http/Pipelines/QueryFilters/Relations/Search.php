<?php

namespace App\Http\Pipelines\QueryFilters\Relations;

use App\Http\Pipelines\QueryFilters\Filter;

class Search extends Filter
{
    protected function applyFilters($builder)
    {
        return $builder
            ->where('name', 'like' , '%' . request($this->filterName()) .'%')
            ->orWhereHas('regency', function($query){
                $query->where('name', 'like' , '%' . request($this->filterName()) .'%');
            });
    }
}
