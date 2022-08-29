<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Traits\HasBannedUser;
use App\Traits\UserAuthorization;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

ini_set('max_execution_time', 500);

class UsersController extends Controller
{
    use UserAuthorization, HasBannedUser;

    public function __construct(protected UserRepository $users)
    {
    }

    public function showEmployee()
    {

        $users = User::whereHas('roles')->get()->filter(fn($user) => $user->name != 'superadmin');

        return view('admin.users.employee')
            ->withUsers($users);
    }

    public function showCustomer()
    {
        // return view('admin.users.customer')->withUsers(
        //     User::doesntHave('roles')->get()->filter(fn($user) => $user->name != 'superadmin')
        // );
        return view('admin.users.customer')->withUsers(Customer::with('banned')->latest()->get());
    }

    public function edit(User $user)
    {
        $roles = Role::excepSuperAdmin()->get();

        return view('admin.users.edit')->withUser($user->load(['roles', 'account']))->withRoles($roles);
    }

    public function update(Request $request, User $user)
    {
        if($user->isAdmin() && $request->roles == 1){
            return back()->withErrors('Tidak dapat mengganti role admin ke karyawan');
        }    

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

    public function detail(User $user)
    {
        $user = $user->load(['account', 'office.office.accomodation:id,name']);

        return view('admin.users.show')->withUser($user);  
    }

    public function destroy(User $user)
    {
        $user->office?->delete();

        $user->delete();

        return back()->withSuccess('Berhasil hapus karyawan');
    }

}
