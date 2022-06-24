<?php  

namespace App\Repositories;

use App\Models\Accomodation;
use App\Models\Facility;
use App\Models\Regency;
use App\Models\Room;
use App\Models\RoomType;
use RahulHaque\Filepond\Facades\Filepond;

class AccomodationRepository
{
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
		$accomodations = Accomodation::withCount('room')->get();

		return compact('accomodations');
	}

	public function createData()
	{
		$rooms = Room::with(['images', 'roomType'])->get();
        $types = RoomType::query()->get();
        $regencies = Regency::query()->get();
        $facilities = Facility::query()->get();

        return compact('rooms', 'types', 'regencies', 'facilities');
	}

	public function storeAccomodation()
	{
		$this->accomodation = Accomodation::create([
            'name' => $this->request->name,
            'address' => $this->request->address,
            'regency_id' => $this->request->regencies
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
            'price' => $this->request->price,
            'discount' => $this->request->discount ?? 0,
        ]);
	}

	public function uploadRoomImage()
	{
		$roomImageName = 'room-' . $this->accomodation->id;

        return Filepond::field($this->request->room_image)
                        ->moveTo('rooms/' . $roomImageName);
	}
}