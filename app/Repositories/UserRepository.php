<?php  

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\DB;

ini_set('max_execution_time', 500);

class UserRepository
{
	protected $users; 
    protected $api;
    protected $admin;

    public function update($request, $user)
    {
        DB::beginTransaction();

        try {

            $request->validate([
                'name' => 'required|string',
                'email' => 'required|string',
                'mobile_number' => 'required|string',
                'password' => 'sometimes|string|confirmed|min:6',
            ]);

            if ($request->has('password')) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'password' => bcrypt($request->password),
                    'e_password' => Crypt::encrypt($request->password)
                ]);
            } else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                ]);
            }

            $user->syncRoles($request->roles);

            DB::commit();

            return redirect(route('users.employee'))->withSuccess('Berhasil edit user ' . $user->name);
            
        } catch (\Exception $e) {

            DB::rollback();

            return redirect(route('users.employee'))->withErrors('Gagl ubah data, error : ' . $e->getMessage());
        }

        
    }

    public function show(Request $request)
    {
        $this->admin = $request->user()->hasRole('admin');

        $this->users = User::whereId($request->user()->id);

        if ($this->admin) {
            $this->users = User::where('id', '!=', 1);
        } 

        $this->users = $this->users->get();

        $this->api = new UserResource($this->users);

        return $this->api;
    }

    public function showTable(Request $request)
    {
       $this->show($request);

        return datatables($this->users)->addIndexColumn()
        ->addColumn('action', function($user) {

            if ($this->admin) {
                return '
                <a href="'. route('users.edit', $user->id) .'" class="btn btn-outline-primary btn-xs">
                    <i class="fas fa-pencil-alt"></i> Edit
                </a> 
                <a href="#" data-id="'. $user->id .'" class="btn btn-outline-danger btn-xs delete-user-btn">
                    <i class="fa fa-trash"></i> Delete
                </a>
                <a href= "'. route('users.fetch', $user->id) .'"  class="btn btn-outline-success btn-xs" onclick="addLoader(event)">
                    <i class="fa fa-wrench"></i> Update 
                </a>
                <a href= "'. route('users.roles', $user->id) .'"  class="btn btn-outline-info btn-xs">
                    <i class="fa fa-cog"></i> Role 
                </a>
                ';
            } 

            return '<a href= "'. route('users.fetch', $user->id) .'"  class="btn btn-success btn-xs" onclick="addLoader(event)">
                    <i class="fa fa-wrench"></i> Update 
                </a>';
        })
        ->make(true);
    }
}