<?php  

namespace App\Traits;

use App\Contracts\UploadServiceInterface;
use App\Models\PaymentList;
use App\Models\Setting;
use Illuminate\Http\Request;

trait HasPointSetting
{
   public function points()
   {
        $points = Setting::where('type', 'point')->get();

        return view('admin.settings.point.index')->withPoints($points);
   }

   public function createPointSetting()
   {
        return view('admin.settings.point.create');
   }

   public function storePointSetting(Request $request)
   {
        $request->validate([
            "name" => "required",
            "is_active" => "required",
            "value" => "required"
        ]);

        Setting::create($request->all());

        return redirect(route('admin.settings.point.index'))->withSuccess('Berhasil Tambah Setting Point');
   }

   public function editPointSetting($id)
   {
        $settings = Setting::findOrFail($id);

        return view('admin.settings.point.edit')->withSetting($settings);
   }

   public function updatePointSetting(Request $request, $id)
   {
        $request->validate([
            "name" => "required",
            "is_active" => "required",
            "value" => "required"
        ]);

        $setting = Setting::findOrFail($id);

        $setting->update($request->all());

        return redirect(route('admin.settings.point.index'))->withSuccess('Berhasil Ubah Setting Point');
   }

   public function deletePointSetting($id)
   {
        $setting = Setting::findOrFail($id);

        $setting->delete();

        return redirect(route('admin.settings.point.index'))->withSuccess('Berhasil Hapus Setting Point');
   }
}