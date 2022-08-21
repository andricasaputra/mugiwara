<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicies;
use Illuminate\Http\Request;

class PrivacyPoliciesController extends Controller
{
    public function index()
    {
        return view('admin.privacy.index')->withPolicies(PrivacyPolicies::all());
    }

    public function create()
    {
        return view('admin.privacy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable',
            'body' => 'required'
        ]);

        PrivacyPolicies::create($request->all());

        return redirect(route('privacy.index'))->withSuccess('Sukses tambah data');
    }

    public function show(PrivacyPolicies $privacy)
    {
        return view('admin.privacy.show')->withPolicy($privacy);
    }

    public function edit(PrivacyPolicies $privacy)
    {
        return view('admin.privacy.edit')->withPolicy($privacy);
    }

    public function update(Request $request, PrivacyPolicies $privacy)
    {
        $request->validate([
            'title' => 'nullable',
            'body' => 'required'
        ]);

        $privacy->update($request->all());

        return redirect(route('privacy.index'))->withSuccess('Sukses tambah diubah');
    }

    public function destroy(PrivacyPolicies $privacy)
    {
        $privacy->delete();

        return redirect(route('privacy.index'))->withSuccess('Sukses tambah dihapus');
    }
}
