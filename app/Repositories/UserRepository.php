<?php  

namespace App\Repositories;

use App\Contracts\UploadServiceInterface;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
                'photo_profile' => 'sometimes|mimes:jpeg,jpg,png|max:100000'
            ]);

            $check = User::where('mobile_number', $request->mobile_number)->first();

            if($user->mobile_number != $request->mobile_number){
                if($check && $check->id != auth()->id()){

                    if(! auth()->user()->isAdmin()){
                        return redirect(route('dashboard'))->withErrors('Isian nomer hp sudah ada sebelumnya');
                    }

                    return redirect(route('users.employee'))->withErrors('Isian nomer hp sudah ada sebelumnya');
                }
            }   

            
            if ($request->has('password')) {

                if($user->mobile_number != $request->mobile_number){
                    $user->update([
                        'name' => $request->name,
                        'mobile_number' => $request->mobile_number,
                        'password' => bcrypt($request->password)
                    ]);
                }else{
                    $user->update([
                        'name' => $request->name,
                        'password' => bcrypt($request->password)
                    ]);
                }


                if($user->email != $request->email){

                    $user->update([
                        'email' => $request->email,
                        'email_verified_at' => NULL
                    ]);

                    $user = $user->fresh();

                    $user->notify(new VerifyEmail);
                    
                }

            } else {

                if($user->mobile_number != $request->mobile_number){
                    $user->update([
                        'name' => $request->name,
                        'mobile_number' => $request->mobile_number,
                    ]);
                }else{
                        $user->update([
                        'name' => $request->name,
                    ]);
                }

                if($user->email != $request->email){

                    $user->update([
                        'email' => $request->email,
                        'email_verified_at' => NULL
                    ]);

                    $user = $user->fresh();

                    $user->notify(new VerifyEmail);

                }

            }

            if ($request->hasFile('photo_profile')) {

                $file = $request->file('photo_profile');
                $factory  = app()->make(UploadServiceInterface::class);
                $fileName = $factory->process($file);

                $user->account()->updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'gender' => $request->gender,
                        'birth_date' => $request->birth_date,
                        'avatar' => $fileName
                    ]
                );

            } else {

                $user->account()->updateOrCreate(
                    [
                        'user_id' => $user->id,
                    ],
                    [
                        'gender' => $request->gender,
                        'birth_date' => $request->birth_date
                    ]
                );
            }

            if ($request->role) {
                $user->syncRoles($request->roles);
            }

            DB::commit();

            if(! $user->isAdmin()){
                return redirect(route('dashboard'))->withSuccess('Berhasil edit user ' . $user->name);
            }

            return redirect(route('users.employee'))->withSuccess('Berhasil edit user ' . $user->name);
            
        } catch (\Exception $e) {

            DB::rollback();

            if(! $user->isAdmin()){
                return redirect(route('dashboard'))->withSuccess('Berhasil edit user ' . $user->name);
            }

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