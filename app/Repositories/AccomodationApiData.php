<?php  

namespace App\Repositories;

use App\Models\Accomodation;

trait AccomodationApiData
{
	public function all()
	{
		return Accomodation::with([
			'room.images', 
			'room.type',
			'province', 
			'regency',
		])
		->withAvg('ratings', 'rating')
		->paginate(10);
	}
}