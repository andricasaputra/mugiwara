<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\UploadServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\ManajemanMenu;
use App\Models\ManajemanMenuRole;
use App\Models\ManajemenSubMenu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class ManajemenMenuController extends Controller
{
    public function index()
    {
        $menus = ManajemanMenu::with(['image', 'role'])->orderBy('id', 'asc')->get();

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
            "is_active" => "nullable",
            "url" => "required",
            "icon_menu" => 'sometimes|mimes:jpg,jpeg,svg,png,ico',
            'role_id' => 'required'
        ]);

        DB::beginTransaction();

        try {

            if($request->submenu){

                $menu = ManajemanMenu::create([
                    "name" => $request->name,
                    "url" => NULL,
                    'amount_child' => $request->amount_child,
                    'is_active' => $request->is_active,
                ]);

                $submenu = [];

                foreach ($request->submenu as $key => $sub) {
                   
                    array_push($submenu, [
                        'manajeman_menu_id' => $menu->id,
                        'name' => $sub,
                        'url' => $request->url[$key],
                        'is_active' => $request->is_active_child[$key],
                    ]);
                }

                ManajemenSubMenu::insert($submenu);

            } else {

                $menu = ManajemanMenu::create([
                    "name" => $request->name,
                    "url" => $request->url,
                    'is_active' => $request->is_active,
                ]);
            }

            foreach($request->role_id as $r){
                ManajemanMenuRole::updateOrCreate(
                    [
                        'menu_id' => $menu->id,
                        'role_id' => $r
                    ]
                );
            }

            if($request->hasFile('icon_menu')){

                $file = $request->file('icon_menu');

                $factory  = app()->make(UploadServiceInterface::class);

                $fileName = $factory->process($file);

                $menu->image()->create([
                    'image' => $fileName
                ]);
            }

            DB::commit();

            return redirect(route('admin.menus.index'))->withSuccess('Berhasil Tambah Setting Manajemen Menu');
            
        } catch (\Exception $e) {

            DB::rollback();

            dd($e);
            
        }

        
    }

    public function edit($id)
    {
        $roles = Role::all();

        $users = User::where('type', 'user')->get();

        $menu = ManajemanMenu::findOrFail($id);

        return view('admin.menu.edit')
            ->withMenu($menu->load(['role', 'image', 'childs']))
            ->withRoles($roles);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "name" => "required",
            "url" => "required",
            'is_active' => 'nullable',
            "icon_menu" => 'sometimes|mimes:jpg,jpeg,svg,png,ico',
            'role_id' => 'required'
        ]);

        DB::beginTransaction();

        try {

            $menu = ManajemanMenu::findOrFail($id);

            //dd($request->all());

            if($request->submenu){

                $menu->update([
                    "name" => $request->name,
                    "url" => "main",
                    'amount_child' => $request->amount_child,
                    'is_active' => $request->is_active,
                ]);

                $submenu = [];

                foreach ($request->submenu as $key => $sub) {
                   
                    array_push($submenu, [
                        'manajeman_menu_id' => $menu->id,
                        'name' => $sub,
                        'url' => $request->url[$key],
                        'is_active' => $request->is_active_child[$key],
                    ]);
                }

                $subs = ManajemenSubMenu::where('manajeman_menu_id', $menu->id)->get();

                $delete = $subs->each(fn($sub) => $sub->delete());

                ManajemenSubMenu::insert($submenu);

            } else {

                $menu->update([
                    "name" => $request->name,
                    "url" => $request->url,
                    'is_active' => $request->is_active,
                ]);

                $subs = ManajemenSubMenu::where('manajeman_menu_id', $menu->id)->get();

                $delete = $subs->each(fn($sub) => $sub->delete());
            }

            //dd($request->all());

            $roles = ManajemanMenuRole::where('menu_id', $menu->id)->get();

            $delete = $roles->each(fn($role) => $role->delete());

            foreach($request->role_id as $r){


                if (! is_null($r)) {

                    ManajemanMenuRole::create([
                        'menu_id' => $menu->id,
                        'role_id' => $r
                    ]);
                    
                } else{

                    ManajemanMenuRole::whereNull('role_id')->first()->delete();
                }
            }

            if($request->hasFile('icon_menu')){

                $file = $request->file('icon_menu');

                $factory  = app()->make(UploadServiceInterface::class);

                $fileName = $factory->process($file);

                $menu->image()->update([
                    'image' => $fileName
                ]);
            }

            DB::commit();

           return redirect(route('admin.menus.index'))->withSuccess('Berhasil Ubah Setting Manajemen Menu');
            
        } catch (\Exception $e) {

            DB::rollback();

            dd($e);
            
        }

        
    }

    public function destroy($id)
    {
        $menu = ManajemanMenu::findOrFail($id);

        $menu->role()->delete();

        $menu->delete();

         return redirect(route('admin.menus.index'))->withSuccess('Berhasil Hapus Setting Manajemen Menu');
    }
}
