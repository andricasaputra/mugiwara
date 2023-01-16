<?php

namespace App\Http\Controllers\Employee;


use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Accomodation;
use App\Models\Facility;
use App\Models\Image;
use App\Models\Room;
use App\Models\RoomNumber;
use App\Models\Type as RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RahulHaque\Filepond\Facades\Filepond;

class RoomController extends Controller
{
    protected $uplaod;
    protected array $files = [];
    protected array $fileName = [];

    public function index()
    {
        $accomodations = Accomodation::where('id', auth()->user()->office?->office?->accomodation_id)->with(['room.type', 'room.images'])->get();
        $types = RoomType::all();

        $rooms = Room::with(['images', 'type', 'accomodation', 'facilities'])->where('accomodation_id', auth()->user()->office?->office?->accomodation_id)->get();

        return view('employee.booking.rooms.index')
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

        return view('employee.booking.rooms.index')
                ->withRooms($rooms->get())
                ->withAccomodations($accomodations)
                ->withtypes($types);
    }

    public function create()
    {
        $types = RoomType::query()->get();

        return view('employee.booking.rooms.create')->withTypes($types);
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

            return redirect(route('employee.rooms.index'))->withSuccess('Berhasil tambah data');
            
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
        $numbers = RoomNumber::query()->get();

        return view('employee.booking.rooms.edit')
            ->withAccomodation($accomodation->load(['room.type', 'room.facilities']))
            ->withTypes($types)
             ->withFacilities($facilities)
             ->withNumbers($numbers);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'price' => 'required|numeric',
                'discount_type' => 'nullable|string',
                'discount_amount' => 'nullable|string',
            ]);

            $accomodation = Accomodation::findOrFail($id);
            $rooms = $accomodation->room;

            foreach ($rooms as $room) :

                $room->update([
                    "price" => $request->price ,
                    "discount_type" => $request->discount_type ,
                    "discount_amount" => $request->discount_amount ,
                ]);

            endforeach;

            DB::commit();

            return redirect(route('employee.rooms.index'))->withSuccess('Berhasil ubah data');
            
        } catch (\Exception $e) {

            DB::rollback();

            return back()->withErrors('Gagal ubah data! Error : ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
       try {

            $accomodation = Accomodation::findOrFail($id);

            foreach ($accomodation?->room as $key => $room) {

                foreach($room->images as $image){

                    if(file_exists(asset('storage/rooms/' . $image->image))){
                       \Illuminate\Support\Facades\Storage::disk('public')->delete('rooms/'. $image->image);
                    }

                    $image->delete();
                }

                $room->facilities()?->delete();
                $room->reviews()?->delete();
                $room->delete();
            }

            $accomodation->delete();

            return redirect(route('employee.rooms.index'))->withSuccess('Berhasil hapus data'); 
           
       } catch (\Exception $e) {

            return redirect(route('employee.rooms.index'))->withErrors('Gagal hapus data, terdapat pembayaran pada hotel yang akan dihapus'); 
       }
    }

    protected function upload()
    {
        foreach($this->files as $file){
            $this->fileName[] = $this->upload->process($file);
        }
    }

    public function uploadRoomImage($request, $accomodation)
    {
        $roomImageName = 'room-' . $accomodation->id . '-' . time();

        return Filepond::field($request->room_image)
                        ->moveTo('rooms/' . $roomImageName);
    }

    public function destroyImage($id){

        $image = Image::findOrFail($id);

        if(file_exists(asset('storage/rooms/' . $image->image))){
           \Illuminate\Support\Facades\Storage::disk('public')->delete('rooms/'. $image->image);
        }

        $image->delete();

        return response()->json([
            'message' => "Berhasil hapus gambar"
        ]);
    }

}
