<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeletedUser;
use Illuminate\Http\Request;

class DeletedUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deleteds = DeletedUser::with(['reason'])->latest()->get();

        $deleteds = $deleteds->map(function($deleted){
            $user = $deleted->user()->withTrashed()->first();

            $deleted = $deleted->reason?->only(['id', 'reason', 'description']);

            $user = $user->only(['name', 'email', 'mobile_number', 'deleted_at']);

            return collect($deleted)->merge($user);
        });

        return view('admin.users.delete.index')->withDeleteds($deleteds);
    }

    public function restore($id)
    {
        $deleted_user = DeletedUser::findOrFail($id);

        $deleted_user->user()->restore();

        $deleted_user->delete();

        return redirect(route('users.deleted.index'))->withSuccess('Berhasil Restore Akun');
    }
}
