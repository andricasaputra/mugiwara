<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\UploadServiceInterface;
use App\Events\CustomRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Nette\Utils\Random;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Notifications\VerifyEmail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile_number' => ['required', 'string', 'max:13', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::beginTransaction();

        try {

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile_number' => $request->mobile_number,
                'mobile_verify_code' => Random::generate(6, 1234567890),
                'mobile_attempts_left' => 4,
                'password' => Hash::make($request->password),
            ]);

            $user->assignRole('employee');

            $user->account()->create([
                'gender' => $request->gender,
                'birth_date' => $request->birth_date
            ]);

            if ($request->hasFile('photo_profile')) {

                $file = $request->file('photo_profile');
                $factory  = app()->make(UploadServiceInterface::class);
                $fileName = $factory->process($file);
                $user->account()?->update([
                    'avatar' => $fileName
                ]);
            }
            
            //event(new CustomRegistered($user));
           $user->notify(new VerifyEmail);

            DB::commit();

            return redirect(route('users.employee'))->withSuccess('Berhasil tambah user baru');
        } catch (\Exception $e) {

            DB::rollback();

             return back()->withErrors('Gagal tambah user baru, Error : ' . $e->getMessage());
            
        }
    }
}
