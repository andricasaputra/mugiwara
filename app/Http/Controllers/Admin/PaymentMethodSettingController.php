<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethodList;
use Illuminate\Http\Request;

class PaymentMethodSettingController extends Controller
{
    public function index()
    {
        $methods = PaymentMethodList::all();

        return view('admin.settings.payment.method.index')->withMethods($methods);
    }

    public function create()
    {
        return view('admin.settings.payment.method.create');
    }

    public function store(Request $request)
    {
        PaymentMethodList::create($request->all());
        
        return redirect(route('admin.payments_methods.index'))->withSuccess('Berhasil Tambah Data');
    }

    public function edit($id)
    {
        $method = PaymentMethodList::find($id);

        return view('admin.settings.payment.method.edit')->withMethod($method);
    }

    public function update(Request $request, $id)
    {
        $methods = PaymentMethodList::find($id);

        $methods->update($request->all());

        return redirect(route('admin.payments_methods.index'))->withSuccess('Berhasil Ubah Data');
    }

    public function destroy($id)
    {
        $methods = PaymentMethodList::find($id);

        $methods->delete();

        return redirect(route('admin.payments_methods.index'))->withSuccess('Berhasil Hapus Data');
    }

}
