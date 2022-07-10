<?php  

namespace App\Repositories;

use App\Models\Accomodation;
use Illuminate\Pipeline\Pipeline;
use App\Http\Pipelines\QueryFilters\Take;

trait AccomodationApiData
{
	public function all()
	{
        $accomodations = Accomodation::with([
			'room.images', 
			'room.type',
			'province', 
			'regency',
		])
		->withAvg('reviews', 'rating');

		return  app(Pipeline::class)
            ->send($accomodations)
            ->through([
            	 \App\Http\Pipelines\QueryFilters\Sort::class,
                \App\Http\Pipelines\QueryFilters\Relations\Search::class,
                \App\Http\Pipelines\QueryFilters\Relations\Status::class,
                \App\Http\Pipelines\QueryFilters\Relations\Category::class,
            ])
            ->thenReturn()
            ->paginate(Take::getDefaultPerPage())
            ->appends(request()->input());
	}
}