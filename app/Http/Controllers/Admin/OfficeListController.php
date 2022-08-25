<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeStoreRequest;
use App\Models\Accomodation;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeListController extends Controller
{
    public function index()
    {
        $offices = Office::latest()->with(['users', 'accomodation'])->get();

        return view('admin.offices.index')->withOffices($offices);
    }

    public function create()
    {
         $acc = [];

         $offices = Office::with(['users', 'accomodation'])->get();

        foreach($offices as $office){

            if (is_null($office->accomodation)) {
                continue;
            } else {
                array_push($acc, $office->accomodation->id);
            }
        }

        $accomodations = Accomodation::whereNotIn('id', $acc)->get();
        //$employees = User::doesntHave('office')->employee()->get();
        $employees = User::employee()->get();

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
        DB::beginTransaction();

        try {

            $office = Office::create([
                "name" => $request->name,
                "type" => $request->type,
                "address" => $request->address,
                "mobile_number" => $request->mobile_number,
                "accomodation_id" => $request->accomodation_id,
            ]);

            foreach($request->user_id as $id){
                $office->users()->create([
                    'user_id' => $id
                ]);
            }

            DB::commit();

            return redirect(route('offices.index'))->withSuccess('Berhasil Tambah Data Informasi Kantor');
           
       } catch (\Exception $e) {
           
            DB::rollback();

            return redirect(route('offices.index'))->withErrors('Gagal Tambah Data Informasi Kantor, Error : ' . $e->getMessage());
       }
    }

    public function edit(Office $office)
    {
        $users = User::whereType('user')->whereNotIn('id', [1, 2])->get();
        $employees = User::doesntHave('office')->employee()->get();
        $accomodations = Accomodation::get();

        return view('admin.offices.edit')
            ->withUsers($users)
            ->withAccomodations($accomodations)
            ->withEmployees($employees)
            ->withOffice($office->load(['users', 'accomodation']));
    }

    public function update(OfficeStoreRequest $request, Office $office)
    { 
        DB::beginTransaction();

        try {

            $office->update([
              "name" => $request->name,
              "type" => $request->type,
              "address" => $request->address,
              "accomodation_id" => $request->accomodation_id,
            ]);

            foreach($request->user_id as $id){
                $office->users()->create([
                    'user_id' => $id
                ]);
            }

            DB::commit();

            return redirect(route('offices.index'))->withSuccess('Berhasil Ubah Data Informasi Kantor');
            
        } catch (\Exception $e) {

            DB::rollback();

             return redirect(route('offices.index'))->withErrors('BGagal Ubah Data Informasi Kantor, Error ' . $e->getMessage());
            
        }
    }

    public function destroy(Office $office)
    {
        $office->users()->delete();

        $office->delete();

        return redirect(route('offices.index'))->withSuccess('Berhasil Hapus Data Informasi Kantor');
    }
}
