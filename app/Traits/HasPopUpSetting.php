<?php  

namespace App\Traits;

use App\Contracts\UploadServiceInterface;
use App\Models\SettingPopUp;
use App\Traits\HasOldImageToDelete;
use App\Uploads\PopUpImageService;
use Illuminate\Http\Request;

trait HasPopUpSetting
{
     use HasOldImageToDelete;

   public function popUpSetting()
   {
        $popUpS = SettingPopUp::with('image')->get();

        return view('admin.settings.popup.index')->with('popups', $popUpS);
   }

   public function createPopUpSetting()
   {
        return view('admin.settings.popup.create');
   }

   public function storePopUpSetting(Request $request)
   {
        $request->validate([
            "title" => "required",
            'description' => 'required',
            'image' => 'sometimes|image'
        ]);

        $popup = SettingPopUp::create($request->except('image'));

        if($request->image && $request->hasFile('image')){

           $upload = new PopUpImageService;
           $imagename = $upload->process($request->image);

           $popup->image()->create([
               'image' => $imagename
           ]);
       }

        return redirect(route('admin.settings.popup'))->withSuccess('Berhasil Tambah Setting Popup Web');
   }

   public function editPopUpSetting($id)
   {
        $settings = SettingPopUp::findOrFail($id);

        return view('admin.settings.popup.edit')->with('popup', $settings);
   }

   public function updatePopUpSetting(Request $request, $id)
   {
        $request->validate([
            "title" => "required",
            'description' => 'required',
            'is_active' => 'required',
            'image' => 'sometimes|image'
        ]);

        $popup = SettingPopUp::findOrFail($id);

        $popup->update($request->except('image'));

        if($request->image && $request->hasFile('image')){

          if(! is_null($popup->image?->image)){
               $this->deleteOldImage($popup, 'popups');
           }

           $upload = new PopUpImageService;
           $imagename = $upload->process($request->image);

           $popup->image()->create([
               'image' => $imagename
           ]);
       }

        return redirect(route('admin.settings.popup'))->withSuccess('Berhasil Ubah Setting Popup Web');
   }

   public function destroyPopUpSetting($id)
   {
        $setting = SettingPopUp::findOrFail($id);

        $setting->delete();

        return redirect(route('admin.settings.popup'))->withSuccess('Berhasil Hapus Setting Popup Web');
   }
}