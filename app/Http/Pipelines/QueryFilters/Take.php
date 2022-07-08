<?php

namespace App\Http\Pipelines\QueryFilters;

class Take
{
    public static int $perPage = 10;

    public static function __callStatic($method,  $props)
    {
        if (request()->has('take')) {
            static::$perPage = request()->take;
        }
        
        return static::$perPage; 
    }
}
