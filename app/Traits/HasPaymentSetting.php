<?php  

namespace App\Traits;

use App\Contracts\UploadServiceInterface;
use App\Models\PaymentList;
use Illuminate\Http\Request;

trait HasPaymentSetting
{
	public function paymentList()
    {
        return view('admin.settings.payment.index')->withLists(PaymentList::all());
    }

    public function paymentEdit($id)
    {
        $payment = PaymentList::findOrFail($id);

        return view('admin.settings.payment.edit')->withPayment($payment);
    }

    public function paymentUpdate(Request $request, $id)
    {
        $payment = PaymentList::findOrFail($id);
        

        if($request->hasFile('image')){
            $upload = app()->make(UploadServiceInterface::class);
            $image = $upload->process($request->file('image'));

            $payment->image = url('storage/payments/' . $image);
        }

        $payment->is_active = $request->is_active;

        $payment->save();

        return redirect(route('admin.settings.payment'))->withSuccess('Berhasil Ubah Data');
    }
}