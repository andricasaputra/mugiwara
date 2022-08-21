<?php  

namespace App\Traits;

use App\Models\User;
use Illuminate\Http\Request;

trait HasBannedUser
{
    public function bannedPage(User $user)
    {
        return view('admin.users.banned')->withUser($user);
    }

	public function banned(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->banned()->create([
            'user_id' => $user->id,
            'reason' => $request->reason,
            'banned_date' => now()
        ]);

        return redirect(route('users.customer'))->withSuccess('User Sukses di Banned');
    }

    public function release(Request $request)
    {
        $user = User::findOrFail($request->user_id);

        $user->banned()->delete();

         return redirect(route('users.customer'))->withSuccess('Banned User Berhasil Dihapaus');
    }
}