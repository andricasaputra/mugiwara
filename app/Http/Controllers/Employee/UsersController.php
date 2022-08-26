<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
        return view('employee.users.employee')->withUsers(
            User::whereHas('roles')->get()->filter(fn($user) => $user->name != 'superadmin'));
    }

    public function showCustomer()
    {
        return view('employee.users.customer')->withUsers(Customer::latest()->get());
    }

    public function edit(User $user)
    {
        $params = request()->route('user')->id;

        if($params != auth()->id()) abort(403);

        $roles = Role::excepSuperAdmin()->get();

        return view('employee.users.edit')->withUser($user->load('roles'))->withRoles($roles);
    }

    public function update(Request $request, User $user)
    {
        return $this->users->update($request, $user); 
    }

}
