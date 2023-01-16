<?php  

namespace App\Traits;

use App\Models\Office;
use App\Models\SettingFeeCabang;
use Illuminate\Http\Request;

trait HasSettingFeeCabang
{

   public function index()
   {
        $fees = SettingFeeCabang::with('office')->get();
        
        return view('admin.settings.fee.index')->with('fees', $fees);
   }

   public function create()
   {
          $offices = Office::has('users')->get();

          return view('admin.settings.fee.create')->withOffices($offices);
   }

   public function store(Request $request)
   {
        $request->validate([
            "office_id" => "required",
            'value' => 'sometimes|numeric',
        ]);

        $fee = SettingFeeCabang::create($request->all());

        return redirect(route('admin.settings.fee.index'))->withSuccess('Berhasil Tambah Setting Fee');
   }

   public function edit($id)
   {
        $fee = SettingFeeCabang::findOrFail($id);

        $offices = Office::has('users')->get();

        return view('admin.settings.fee.edit')->with('fee', $fee)->withOffices($offices);
   }

   public function update(Request $request, $id)
   {
        $request->validate([
            "office_id" => "required",
            'value' => 'sometimes|numeric',
        ]);

        $fee = SettingFeeCabang::findOrFail($id);

        $fee->update($request->all());

        return redirect(route('admin.settings.fee.index'))->withSuccess('Berhasil Ubah Setting Fee');
   }

   public function destroy($id)
   {
        $fee = SettingFeeCabang::findOrFail($id);

        $fee->delete();

        return redirect(route('admin.settings.fee.index'))->withSuccess('Berhasil Hapus Setting Fee');
   }
}