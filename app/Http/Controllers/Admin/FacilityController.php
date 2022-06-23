<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacilityController extends Controller
{
    protected $uplaod;
    protected $files = [];
    protected $fileName = [];

    public function index()
    {
        $facilities = Facility::query()->get();

        return view('admin.booking.facilities.index')->withfacilities($facilities);
    }

    public function create()
    {
        return view('admin.booking.facilities.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'image' => 'required',
            ]);

            if($request->hasFile('image')){

                $this->files = $request->file('image');

                $this->upload  = app()->make(UploadServiceInterface::class);

                $this->fileName = $this->upload->process($this->files);
            }

            $datas = collect($request)->merge(['image' => $this->fileName])->all();

            $facility = Facility::create($datas);

            DB::commit();

            return redirect(route('facilities.index'))->withSuccess('Berhasil tambah data');
            
        } catch (\Exception $e) {

            DB::rollback();

            return back()->withErrors('Gagal tambah data, error : ' . $e->getMessage());
        }
    }

    public function edit(Facility $facility)
    {
        return view('admin.booking.facilities.edit')->withFacility($facility);
    }

    public function update(Request $request, Facility $facility)
    {
        try {

            $request->validate([
                'name' => 'required|string',
                'description' => 'nullable|string',
                'image' => 'sometimes',
            ]);

            if($request->hasFile('image')){

                $this->upload($request);

                $datas = collect($request)->merge(['image' => $this->fileName])->all();
            } else {

                $datas = $request->except('image');

            }

            $facility->update($datas);

            return redirect(route('facilities.index'))->withSuccess('Berhasil ubah data');
            
        } catch (\Exception $e) {
            return back()->withErrors('Gagal ubah data, error : ' . $e->getMessage());
        }
    }

    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect(route('facilities.index'))->withSuccess('Berhasil hapus data'); 
    }

    protected function upload($request)
    {
        $this->files = $request->file('image');

        $this->upload  = app()->make(UploadServiceInterface::class);

        $this->fileName = $this->upload->process($this->files);
    }
}
