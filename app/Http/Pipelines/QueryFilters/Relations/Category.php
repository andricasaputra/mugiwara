<?php

namespace App\Http\Pipelines\QueryFilters\Relations;

use App\Http\Pipelines\QueryFilters\Filter;

class Category extends Filter
{

    protected function applyFilters($builder)
    {
        if (request($this->filterName()) == 'rekomendasi') {

            $builder = $builder->whereHas('roomAvailable', function($query){
                $query->whereNotNull('discount_type');
            });

        } elseif(request($this->filterName()) == 'populer'){

            $builder = $builder->whereHas('roomAvailable', function($query){
                $query->whereRaw('status = "booked"');
            });

        } elseif(request($this->filterName()) == 'trending'){

            $builder = $builder->whereHas('ratings', function($query){
                $query->whereRaw('rating > 4.5');
            });
            
        }

        return $builder;
    }

}
