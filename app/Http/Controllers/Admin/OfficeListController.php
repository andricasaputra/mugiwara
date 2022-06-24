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
        dd($request->all());
    }

    public function edit(Office $office)
    {
        return view('admin.offices.edit')->withOffice($office);
    }

    public function uodate(OfficeStoreRequest $request, Office $office)
    {
        dd($request->all());
    }

    public function destroy(Request $request)
    {

    }
}
