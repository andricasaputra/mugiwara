<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccomodationRequest;
use App\Http\Requests\StoreRoomRequest;
use App\Models\Accomodation;
use App\Models\District;
use App\Models\Facility;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Room;
use App\Models\RoomType;
use App\Repositories\AccomodationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RahulHaque\Filepond\Facades\Filepond;

class AccomodationController extends Controller
{
    protected $uplaod;
    protected array $files = [];
    protected array $fileName = [];

    public function __construct(protected AccomodationRepository $repository)
    {
    }

    public function index()
    {
        $datas = $this->repository->indexData();

        return view('admin.booking.accomodations.index', $datas);
    }

    public function create()
    {
        $datas = $this->repository->createData();

        return view('admin.booking.accomodations.create', $datas);
    }

    public function store(AccomodationRequest $request)
    {

        try {

            $this->repository->setRequest($request);

            $accomodation = $this->repository->storeAccomodation();

            $rooms = $this->repository->storeRoom();

            foreach ($rooms as $key => $room) {

                 if($request->has('room_image'))
                $this->files = $this->repository->uploadRoomImage();

                $files = collect($this->files)->map(function($file){
                    return ['image' => $file['basename']];
                })->all();

               $room->facilities()->attach($request->facility);

                $room->images()->createMany($files);
            }

            return redirect(route('accomodations.index'))->withSuccess('Berhasil tambah data');

        } catch (\Exception $e) {

            DB::rollback();

            return back()->withErrors('Gagal tambah data, error : ' . $e->getMessage());
        }
    }

    public function add(Accomodation $accomodation)
    {
        $datas = $this->repository->createData();

        $datas['accomodation'] = $accomodation;

        return view('admin.booking.accomodations.room_create', $datas);
    }

    public function storeRoom(StoreRoomRequest $request)
    {
        return dd($request->all());
        DB::beginTransaction();

        $check = Room::where('accomodation_id', $request->accomodation_id)->where('type_id', $request->type_id)->first();

        if($check){

            $price = (int) preg_replace('/[^0-9]/', '', $request->price);


            if($check->price != $price){

                return back()->withErrors("Harga kamar pada tipe {$check->type?->name} seharusnya adalah {$check->price}");

            }elseif($check->discount_type != $request->discount_type){

                $dscount = $check->discount_type ?? 'kosong';

                return back()->withErrors("Diskon kamar pada tipe {$check->type?->name} seharusnya adalah {$dscount}");
            }

        }

        try {

            $this->repository->setRequest($request);

            $accomodation = $this->repository->getAccomodation();

            $room = $this->repository->storeRoom();

            if($request->has('room_image'))
                $this->files = $this->repository->uploadRoomImage();

            $files = collect($this->files)->map(function($file){
                return ['image' => $file['basename']];
            })->all();

           $room->facilities()->attach($request->facility);

            $room->images()->createMany($files);

            DB::commit();

            return redirect(route('accomodations.index'))->withSuccess('Berhasil tambah data');

        } catch (\Exception $e) {

            DB::rollback();

            return back()->withErrors('Gagal tambah data, error : ' . $e->getMessage());
        }
    }

    public function edit(Accomodation $accomodation)
    {
        $provinces = Province::all();
        $regencies = Regency::where('province_id', $accomodation->province_id)->get();
        $districts = District::where('regency_id', $accomodation->regency_id)->get();

        return view('admin.booking.accomodations.edit')
            ->withAccomodation($accomodation->load(['regency.districts']))
            ->withProvinces($provinces)
            ->withRegencies($regencies)
            ->withDistricts($districts);
    }

    public function update(Request $request, Accomodation $accomodation)
    {
        try {

            $request->validate([
                'name' => 'required',
                'province_id' => 'required',
                'regency_id' => 'required',
                'districts_id' => 'required',
                'address' => 'required',
                'description' => 'nullable|string'
            ]);

            $accomodation->update($request->all());

            return redirect(route('accomodations.index'))->withSuccess('Berhasil ubah data');

        } catch (\Exception $e) {

            return back()->withErrors('Gagal ubah data, error : ' . $e->getMessage());
        }
    }

    public function destroy(Accomodation $accomodation)
    {
        $accomodation->delete();

        return redirect(route('accomodations.index'))->withSuccess('Berhasil hapus data');
    }

    public function tambah_kamar(Request $request, $id)
    {
        $datas = $this->repository->tambah_kamar($id);
        return dd($datas);
    }

}
