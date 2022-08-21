<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeStoreRequest;
use App\Models\Accomodation;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class OfficeListController extends Controller
{
    public function index()
    {
        $offices = Office::with(['user', 'accomodation'])->get();

        return view('admin.offices.index')->withOffices($offices);
    }

    public function create()
    {
         $acc = [];

         $offices = Office::with(['user', 'accomodation'])->get();

        foreach($offices as $office){
            //dd($office->accomodation);
            if (is_null($office->accomodation)) {
                continue;
            } else {
                array_push($acc, $office->accomodation->id);
            }
        }

        $accomodations = Accomodation::whereNotIn('id', $acc)->get();
        $employees = User::doesntHave('office')->employee()->get();

        if ($accomodations->isEmpty()) {
            return back()->withWarning('Daftar Pengiapa masih kosong, silahkan tambahkan data penginapan terlebuh dahulu');
        }

        if ($employees->isEmpty()) {
            return back()->withWarning('Daftar karyawan masih kosong, silahkan tambahkan data karyawan terlebuh dahulu');
        }

        return view('admin.offices.create')
                 ->withAccomodations($accomodations)
                ->withEmployees($employees);
    }

    public function store(OfficeStoreRequest $request)
    {

        //dd($request->all());
        $office = Office::create($request->all());

        return redirect(route('offices.index'))->withSuccess('Berhasil Tambah Data Informasi Kantor');
    }

    public function edit(Office $office)
    {
        $users = User::whereType('user')->whereNotIn('id', [1, 2])->get();
        $accomodations = Accomodation::get();

        return view('admin.offices.edit')
            ->withUsers($users)
            ->withAccomodations($accomodations)
            ->withOffice($office->load(['user', 'accomodation']));
    }

    public function update(OfficeStoreRequest $request, Office $office)
    { 

        if($office->accomodation->id != $request->accomodation_id){

            $check = Office::where('accomodation_id', $request->accomodation_id)->first();

            if ($check) {
                $check->delete();
            }

            $office->update([
              "name" => $request->name,
              "type" => $request->type,
              "address" => $request->address,
              "user_id" => $request->user_id,
              "accomodation_id" => $request->accomodation_id,
            ]);

        }else{

            $office->update([
              "name" => $request->name,
              "type" => $request->type,
              "address" => $request->address,
              "user_id" => $request->user_id,
            ]);

        }

        return redirect(route('offices.index'))->withSuccess('Berhasil Ubah Data Informasi Kantor');
    }

    public function destroy(Office $office)
    {
        $office->delete();

        return redirect(route('offices.index'))->withSuccess('Berhasil Hapus Data Informasi Kantor');
    }
}
