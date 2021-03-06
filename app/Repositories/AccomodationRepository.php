<?php  

namespace App\Repositories;

use App\Models\Accomodation;
use App\Models\Facility;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Room;
use App\Models\Type as RoomType;
use RahulHaque\Filepond\Facades\Filepond;

class AccomodationRepository
{
	use AccomodationApiData;

	protected $request;
	protected $accomodation;

	public function setRequest($request)
	{
		$this->request = $request;
	}

	public function getAccomodation()
	{
		$this->accomodation = Accomodation::findOrFail($this->request->accomodation_id);

		return $this->accomodation;
	}

	public function indexData()
	{
		$accomodations = Accomodation::latest()->withCount('room')->withAvg('reviews', 'rating')->get();

		return compact('accomodations');
	}

	public function createData()
	{
		$rooms = Room::with(['images', 'type'])->get();
        $types = RoomType::query()->get();
        $regencies = Regency::query()->get();
        $provinces = Province::query()->get();
        $facilities = Facility::query()->get();

        return compact('rooms', 'types', 'regencies', 'facilities', 'provinces');
	}

	public function storeAccomodation()
	{
		$this->accomodation = Accomodation::create([
            'name' => $this->request->name,
            'address' => $this->request->address,
            'province_id' => $this->request->province_id,
            'regency_id' => $this->request->regency_id,
            'districts_id' => $this->request->districts_id,
            'lat' => $this->request->lat,
            'lang' => $this->request->lang,
            'description' => $this->request->description_acc,
        ]);

        return $this->accomodation;
	}

	public function storeRoom()
	{
		return Room::create([
            'accomodation_id' => $this->accomodation->id,
            'room_number' => $this->request->room_number,
            'type_id' => $this->request->type_id,
            'max_guest' => $this->request->max_guest,
            'price' => (int) preg_replace('/[^0-9]/', '', $this->request->price),
            'discount_type' => $this->request->discount_type,
            'discount_amount' => $this->request->discount_amount ?? 0,
            'description' => $this->request->description_room,
        ]);
	}

	public function uploadRoomImage()
	{
		$roomImageName = 'room-' . $this->accomodation->id;

        return Filepond::field($this->request->room_image)
                        ->moveTo('rooms/' . $roomImageName);
	}
}