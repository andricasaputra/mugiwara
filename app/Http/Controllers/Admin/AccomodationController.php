<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use App\Models\City;
use App\Models\Facility;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class AccomodationController extends Controller
{
    protected $uplaod;
    protected array $files = [];
    protected array $fileName = [];

    public function index()
    {
        $accomodations = Accomodation::query()->get();

        return view('admin.booking.accomodations.index')->withAccomodations($accomodations);
    }

    public function create()
    {
        $rooms = Room::with(['images', 'type'])->get();
        $types = RoomType::query()->get();
        $cities = City::query()->get();
        $facilities = Facility::query()->get();

        return view('admin.booking.accomodations.create')
            ->withRooms($rooms)
            ->withTypes($types)
            ->withCities($cities)
            ->withFacilities($facilities);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        dd($request->all());

        try {

            $request->validate([
                'room_number' => 'required|string',
                'type_id' => 'required|string',
                'price' => 'required|numeric',
                'discount' => 'nullable|string',
                'images' => 'required',
            ]);

            if($request->hasFile('images')){

                $this->files = $request->file('images');
                $this->upload  = app()->make(UploadServiceInterface::class);

                $this->upload();
            }

            $room = Room::create($request->all());

            $files = collect($this->fileName)->map(function($file){
                return ['image' => $file];
            })->all();

            $room->images()->createMany($files);

            DB::commit();

            return redirect(route('accomodations.index'))->withSuccess('Berhasil tambah data');
            
        } catch (\Exception $e) {

            DB::rollback();


            return back()->withErrors('Gagal tambah data, error : ' . $e->getMessage());
        }
    }

    public function edit(Room $room)
    {
        return view('admin.booking.accomodations.edit')->withRoom($room);
    }

    public function update(Request $request, Room $room)
    {
        try {

            $request->validate([
                'name' => [
                    'required',
                    \Illuminate\Validation\Rule::unique('Rooms')->ignore($room->id),
                ]
            ]);

            $room->update($request->all());

            return redirect(route('accomodations.index'))->withSuccess('Berhasil ubah data');
            
        } catch (\Exception $e) {
            return back()->withErrors('Gagal ubah data, error : ' . $e->getMessage());
        }
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect(route('accomodations.index'))->withSuccess('Berhasil hapus data'); 
    }

    protected function upload()
    {
        foreach($this->files as $file){
            $this->fileName[] = $this->upload->process($file);
        }
    }
}
