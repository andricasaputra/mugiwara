<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\UserAuthorization;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

ini_set('max_execution_time', 500);

class UsersController extends Controller
{

    use UserAuthorization;

    public function __construct(protected UserRepository $users)
    {
    }

    public function showEmployee()
    {
        return view('admin.users.employee')->withUsers(
            User::whereHas('roles')->get()->filter(fn($user) => $user->name != 'superadmin'));
    }

    public function showCustomer()
    {
        return view('admin.users.customer')->withUsers(
            User::doesntHave('roles')->get()->filter(fn($user) => $user->name != 'superadmin')
        );
    }

    public function edit(User $user)
    {
        $roles = Role::excepSuperAdmin()->get();

        return view('admin.users.edit')->withUser($user->load('roles'))->withRoles($roles);
    }

    public function update(Request $request, User $user)
    {
        return $this->users->update($request, $user); 
    }

    public function show(Request $request)
    {
        return $this->users->show($request);  
    }

    public function delete(User $user)
    {
        $user->delete();

        return back()->withSuccess('Berhasil delete user');
    }

}
