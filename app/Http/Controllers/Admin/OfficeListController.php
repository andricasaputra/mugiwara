<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeStoreRequest;
use App\Models\Hotel;
use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class OfficeListController extends Controller
{
    public function index()
    {
        $offices = Office::with(['user', 'hotel'])->get();

        return view('admin.offices.index')->withOffices($offices);
    }

    public function create()
    {
        $hotels = Hotel::query()->get();
        $employees = User::employee()->get();

        if ($hotels->isEmpty()) {
            return back()->withWarning('Daftar hotel masih kosong, silahkan tambahkan data hotel terlebuh dahulu');
        }

        if ($employees->isEmpty()) {
            return back()->withWarning('Daftar karyawan masih kosong, silahkan tambahkan data karyawan terlebuh dahulu');
        }

        return view('admin.offices.create')
                 ->withHotels($hotels)
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
