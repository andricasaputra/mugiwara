<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\ManajemanMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ManajemenMenuController extends Controller
{
    public function index()
    {
        $menus = ManajemanMenu::with(['image', 'role'])->orderBy('id', 'asc')->get();

        //dd($menus);

        return view('admin.menu.index')->withMenus($menus);
    }

    public function create()
    {
        $roles = Role::all();

        $users = User::where('type', 'user')->get();

        return view('admin.menu.create')
            ->withRoles($roles);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "is_active" => "required",
            "url" => "required",
            "icon_menu" => 'sometimes|mimes:jpg,jpeg,svg,png,ico',
            'role_id' => 'required'
        ]);

        $menu = ManajemanMenu::create($request->except(['role_id', '_token', 'icon_menu']));

        foreach($request->role_id as $r){
            $menu->role()->create(['role_id' => $r]);
        }

        if($request->hasFile('icon_menu')){

            $file = $request->file('icon_menu');

            $factory  = app()->make(UploadServiceInterface::class);

            $fileName = $factory->process($file);

            $menu->image()->create([
                'image' => $fileName
            ]);
        }

        return redirect(route('admin.menus.index'))->withSuccess('Berhasil Tambah Setting Manajemen Menu');
    }

    public function edit($id)
    {
        $roles = Role::all();

        $users = User::where('type', 'user')->get();

        $menu = ManajemanMenu::findOrFail($id);

        return view('admin.menu.edit')
            ->withMenu($menu)
            ->withRoles($roles);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "url" => "required",
            "icon_menu" => 'sometimes|mimes:jpg,jpeg,svg,png,ico',
            'role_id' => 'required'
        ]);

        //dd($request->role_id);

        $menu = ManajemanMenu::findOrFail($id);

        $menu->update($request->except(['role_id', '_token', 'icon_menu']));

        //dd($request->role_id);

        foreach($request->role_id as $r){
  
            $menu->role()->update(['role_id' => $r]);
        }

        if($request->hasFile('icon_menu')){

            $file = $request->file('icon_menu');

            $factory  = app()->make(UploadServiceInterface::class);

            $fileName = $factory->process($file);

            $menu->image()->create([
                'image' => $fileName
            ]);
        }

        return redirect(route('admin.menus.index'))->withSuccess('Berhasil Ubah Setting Manajemen Menu');
    }

    public function destroy($id)
    {
        $menu = ManajemanMenu::findOrFail($id);

        $menu->role()->delete();

        $menu->delete();

         return redirect(route('admin.menus.index'))->withSuccess('Berhasil Hapus Setting Manajemen Menu');
    }
}