<?php

namespace App\Http\Controllers\Admin;


use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use App\Models\Facility;
use App\Models\Room;
use App\Models\Type as RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    protected $uplaod;
    protected array $files = [];
    protected array $fileName = [];

    public function index()
    {
        $accomodations = Accomodation::with('room.type')->get();
        $types = RoomType::all();

        $rooms = Room::with(['images', 'type', 'accomodation', 'facilities'])->get();

        return view('admin.booking.rooms.index')
            ->withRooms($rooms)
                ->withAccomodations($accomodations)
                ->withtypes($types);
    }

     public function filter(Request $request)
    {
        $accomodations = Accomodation::all();
        $types = RoomType::all();

        $rooms = Room::query();

        if($request->accomodation_id && $request->accomodation_id != 'all'){
            $rooms = $rooms->where('accomodation_id', $request->accomodation_id);
        }

        if($request->type_id && $request->type_id != 'all'){
            $rooms = $rooms->where('type_id', $request->type_id);
        }

        if($request->status && $request->status != 'all'){
            $rooms = $rooms->where('status', $request->status);
        }

        //$rooms->with(['images', 'type', 'accomodation', 'facilities'])->get();

        return view('admin.booking.rooms.index')
                ->withRooms($rooms->get())
                ->withAccomodations($accomodations)
                ->withtypes($types);
    }

    public function create()
    {
        $types = RoomType::query()->get();

        return view('admin.booking.rooms.create')->withTypes($types);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

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

            return redirect(route('rooms.index'))->withSuccess('Berhasil tambah data');
            
        } catch (\Exception $e) {

            DB::rollback();


            return back()->withErrors('Gagal tambah data, error : ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $types = RoomType::all();
        $facilities = Facility::all();
        $accomodation = Accomodation::findOrFail($id);

        return view('admin.booking.rooms.edit')
            ->withAccomodation($accomodation->load(['room.type', 'room.facilities']))
            ->withTypes($types)
             ->withFacilities($facilities);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'type_id' => 'required|string',
                'price' => 'required|numeric',
                'discount' => 'nullable|string',
                'images' => 'nullable',
            ]);



            $accomodation = Accomodation::findOrFail($id);
            $rooms = $accomodation->room;

            foreach ($rooms as $key => $room) {

                if($request->hasFile('images')){

                    $this->files = $request->file('images');
                    $this->upload  = app()->make(UploadServiceInterface::class);

                    $this->upload();

                    $files = collect($this->fileName)->map(function($file){
                        return ['image' => $file];
                    })->all();

                    $room->images()->createMany($files);
                }

                $room->update([
                  "name" => $request->name,
                  "room_number" => $request->room_number,
                  "type_id" => $request->type_id ,
                  "max_guest" => $request->max_guest ,
                  "price" => $request->price ,
                  "discount_type" => $request->discount_type ,
                  "description_room" => $request->description_room,
                  'status' => $request->status,
                  'is_refunded' => $request->is_refunded,
                ]);

                $room->facilities()->sync($request->facility);
                
            }

            DB::commit();

            return redirect(route('rooms.index'))->withSuccess('Berhasil ubah data');
            
        } catch (\Exception $e) {

            DB::rollback();

            return back()->withErrors('Gagal ubah data, error : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $accomodation = Accomodation::findOrFail($id);

        foreach ($accomodation?->room as $key => $room) {
            $room->delete();
        }

        return redirect(route('rooms.index'))->withSuccess('Berhasil hapus data'); 
    }

    protected function upload()
    {
        foreach($this->files as $file){
            $this->fileName[] = $this->upload->process($file);
        }
    }

}
