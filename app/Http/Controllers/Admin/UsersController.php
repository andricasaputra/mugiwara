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

    protected $users;    

    public function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return view('admin.users.index')->withUsers(
            User::query()->get()->filter(fn($user) => $user->name != 'superadmin')
        );
    }

    public function edit(User $user)
    {
        $roles = Role::excepSuperAdmin()->get();

        return view('admin.users.edit')->withUser($user)->withRoles($roles);
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

    public function showTable(Request $request)
    {
       return $this->users->showTable($request);
    }
}
