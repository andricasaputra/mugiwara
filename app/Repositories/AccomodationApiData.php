<?php  

namespace App\Repositories;

use App\Models\Accomodation;
use Illuminate\Pipeline\Pipeline;
use App\Http\Pipelines\QueryFilters\Take;
use Illuminate\Database\Eloquent\Builder;

trait AccomodationApiData
{   
	public function all()
	{
        $accomodations = Accomodation::with([
        	'room' => function($query){
        		if(request()->category == 'rekomendasi'){
					 $accomodations =  $query->whereNotNull('discount_type');
				}
        	},
			'room.images', 
			'province', 
			'regency',
			'room.type' => function($query) {
				if(request()->type) $query->where('name', request()->type);
			},
			'room.facilities' => function($query) {
				
				if(request()->facilities) {

					if(str_contains(request()->facilities, ',')){
						$facilities = explode(",", request()->facilities);

						$query->whereIn('name', $facilities);
					} else {
						$query->where('name', request()->facilities);
					}
				}
			},
		])
		->withAvg('reviews', 'rating')
		->withCount([
			'room',
			'room as available_room_count' => function (Builder $query) {
			    $query->where('status', 'available');
			},
			'room as booked_room_count' => function (Builder $query) {
			    $query->where('status', 'booked');
			},
			'room as stayed_room_count' => function (Builder $query) {
			    $query->where('status', 'stayed');
			}

		]);
		
		if(request()->rating){
			 $accomodations =  $accomodations->having('reviews_avg_rating', '>=', request()->rating);
		}

		if(request()->category == 'trending'){
			
			 $accomodations =  $accomodations->having('reviews_avg_rating', '>=', '4.0');
		}

		return  app(Pipeline::class)
            ->send($accomodations)
            ->through([
            	 \App\Http\Pipelines\QueryFilters\Sort::class,
                \App\Http\Pipelines\QueryFilters\Relations\Search::class,
                \App\Http\Pipelines\QueryFilters\Relations\Status::class,
                //\App\Http\Pipelines\QueryFilters\Relations\Category::class,
                \App\Http\Pipelines\QueryFilters\Relations\Location::class
            ])
            ->thenReturn()
            ->paginate(Take::getDefaultPerPage())
            ->appends(request()->input());


	}
}