<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::excepSuperAdmin()->get();

        return view('admin.roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('admin.roles.create')->withPermissions($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles',
            'permissions' => 'sometimes',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;
        $role->guard_name = 'web';

        $permissions = $request['permissions'];

        $role->save();

        if (! empty($permissions) || ! is_null($permissions) ) {
           foreach ($permissions as $permission) {
                $p = Permission::where('id', '=', $permission)->firstOrFail(); 
                $role = Role::where('name', '=', $name)->first(); 
                $role->givePermissionTo($p);
            }
        }

        return redirect()->route('roles.index')->withSuccess('Role '. $role->name.' added!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:10|unique:roles,name,'.$id,
            'permissions' => 'sometimes',
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        $role->fill($input)->save();

        $p_all = Permission::all();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }

        // if (! empty($permissions) || ! is_null($permissions)) {
        //    foreach ($permissions as $permission) {
        //         $p = Permission::where('id', '=', $permission)->firstOrFail(); 
        //         $role->givePermissionTo($p);
        //     }
        // }

        return redirect()->route('roles.index')->withSuccess('Role '. $role->name .' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->withSuccess('Role deleted!');
    }
}
