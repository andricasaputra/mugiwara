<?php  

namespace App\Traits;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

trait UserAuthorization
{
	public function roles(User $user)
    {
        $roles = Role::all();

        return view('admin.users.roles')->withUser($user)->withRoles($roles);
    }

    public function attachRoles(Request $request, User $user)
    {
        $user->syncRoles($request->roles);

        return back()->withSuccess('Roles added');
    }

    public function showRoles(Request $request)
    {
        return response()->json($request->user()->roles->pluck('name'));
    }

    public function permissions(User $user)
    {
        $permissions = Permission::all();

        return view('admin.users.permissions')->withUser($user)->withPermissions($permissions);
    }

    public function attachPermissions(Request $request, User $user)
    {
        $user->syncPermissions($request->permissions);

        return back()->withSuccess('permissions added');
    }

    public function showPermissions(Request $request)
    {
        return response()->json($request->user()->permissions->pluck('name'));
    }
}