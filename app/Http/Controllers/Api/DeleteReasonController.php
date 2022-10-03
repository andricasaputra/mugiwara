<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeleteReason;
use App\Models\DeletedUser;
use Illuminate\Http\Request;

class DeleteReasonController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => DeleteReason::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'delete_reason_id' => 'required'
        ]);

        try {

            $check = DeletedUser::where('user_id', $request->user()->id)->first();

            if($check){

                return response()->json([
                    'message' => 'User Has Been Deleted'
                ]);

            }

            if($request->user()->hasRole('admin')){
                return response()->json([
                    'message' => 'Cannot Delete Admin'
                ]);
            }

            $deletedUser = DeletedUser::create([
                'user_id' => $request->user()->id,
                'delete_reason_id' => $request->delete_reason_id
            ]);

            $request->user()->update([
                'device_token' => NULL
            ]);

            $request->user()->tokens()->delete();

            $request->user()->delete();

            return response()->json([
                'message' => 'User Deleted Successfully',
                'data' => $deletedUser->load(['reason:id,reason,description'])
            ]);
            
        } catch (\Exception $e) {
             return response()->json([
                'message' => 'Failed Deleted User, Error : ' . $e->getMessage()
            ]);
        }
    }
}
