<?php  

namespace App\Traits;

use App\Models\Setting;
use Illuminate\Http\Request;

trait HasTaxSetting
{
	public function taxSetting()
    {
        $setting = Setting::where('type', 'tax')->latest()->get();

        return view('admin.settings.tax.index')->withTaxs($setting);
    }

    public function createTaxSetting()
    {
        return view('admin.settings.tax.create');
    }

    public function editTaxSetting(Setting $setting)
    {
        return view('admin.settings.tax.edit')->withSetting($setting);
    }

    public function storeTaxSetting(Request $request)
    {
        $request->validate([
            "is_active" => "required"
        ]);

        Setting::create($request->all());

        return redirect(route('admin.settings.tax'))->withSuccess('Berhasil Tambah Data');
    }

    public function updateTaxSetting(Request $request, Setting $setting)
    {

        $setting->update($request->all());

        return redirect(route('admin.settings.tax'))->withSuccess('Berhasil Ubah Data');
    }

    public function destroyTaxSetting(Setting $setting)
    {
        $setting->delete();

        return redirect(route('admin.settings.tax'))->withSuccess('Berhasil Hapus Data');
    }
}