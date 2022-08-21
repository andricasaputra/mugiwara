<?php

namespace App\Http\Controllers\Employee;

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
        $accomodations = Accomodation::query()->get();
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
        $office = Office::create($request->all());

        return redirect(route('offices.index'))->withSuccess('Berhasil Tambah Data Informasi Kantor');
    }

    public function edit(Office $office)
    {
        $users = User::whereType('user')->get();
        $accomodations = Accomodation::get();

        return view('admin.offices.edit')
            ->withUsers($users)
            ->withAccomodations($accomodations)
            ->withOffice($office->load(['user', 'accomodation']));
    }

    public function update(OfficeStoreRequest $request, Office $office)
    {
        $office->update($request->all());

        return redirect(route('offices.index'))->withSuccess('Berhasil Ubah Data Informasi Kantor');
    }

    public function destroy(Office $office)
    {
        $office->delete();

        return redirect(route('offices.index'))->withSuccess('Berhasil Hapus Data Informasi Kantor');
    }
}
