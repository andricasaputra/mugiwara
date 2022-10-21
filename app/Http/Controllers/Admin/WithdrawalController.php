<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Withdraw;
use App\Notifications\UserWithdrawalStatusNotification;
use App\Traits\HasOldImageToDelete;
use App\Uploads\WithdrawTransferImageService;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    use HasOldImageToDelete;
    
    public function index()
    {
        $withdraws = Withdraw::with(['user', 'image'])->latest()->get();

        return view('admin.finance.withdraw.index')->with('withdraws', $withdraws);
    }

    public function action(Withdraw $withdraw)
    {
        return view('admin.finance.withdraw.action')->with('withdraw', $withdraw);
    }

    public function actionStore(Request $request)
    {
        try {

            $request->validate([
                'status' => 'required',
                'reason_rejected' => 'sometimes',
                'bukti_transfer' => 'sometimes|image'
            ]);

            \DB::beginTransaction();

            $withdraw = Withdraw::find($request->id);

            $withdraw->update([
                'accomodation_id' => $request->accomodation_id,
                'status' => $request->status,
                'reject_reason' => $request->reject_reason,
            ]);

            if($request->bukti_transfer && $request->hasFile('bukti_transfer')){

                if(! is_null($withdraw->image?->image)){
                    $this->deleteOldImage($withdraw, 'withdraws');
                }

                $upload = new WithdrawTransferImageService;
                $imagename = $upload->process($request->bukti_transfer);

                $withdraw->image()->create([
                    'image' => $imagename
                ]);
            }

            \DB::commit();

            if($request->status == 'APPROVED'){
                $status = 'Di Setjui';
            }elseif($request->status == 'REJECTED'){
                $status = 'Di Tolak';
            }else{
                $status = 'Masih Pending';
            }

            $admin_cabang = User::find($withdraw->user_id);

            $title = "Status Pengajuan Permohonan Penarikan Saldo Anda " . $status;

            event(new \App\Events\WithdrawResponseBroadcastEvent($title));

            $admin_cabang->notify(new UserWithdrawalStatusNotification($withdraw, $title));

            return redirect(route('admin.withdraw.index'))->withSuccess('Withdrawal berhasil diproses');
            
        } catch (\Exception $e) {

            \DB::rollback();

            return redirect(route('admin.withdraw.index'))->withErrors('Withdrawal gagal diproses,  Error : ' . $e->getMessage());
            
        }

    }
}
