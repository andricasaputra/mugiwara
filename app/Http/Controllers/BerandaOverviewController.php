<?php

namespace App\Http\Controllers;

use App\Models\BerandaOverview;
use Illuminate\Http\Request;

class BerandaOverviewController extends Controller
{
    public function index()
    {
        $overview = BerandaOverview::all();
        return view('admin.beranda_overview.index', [
            'overview' => $overview
        ]);
    }

    public function create()
    {
        return view('admin.beranda_overview.create');
    }

    public function store(Request $request)
    {
        $prevOverview = BerandaOverview::orderBy('order', 'desc')->first();
        $order = 1;
        if (!is_null($prevOverview)) {
            $order = $prevOverview->order + 1;
        }

        $overview = new BerandaOverview;
        $overview->fill($request->except('order'));
        $overview->order = $order;
        $overview->save();

        return redirect()->route('admin.beranda-overview.beranda-overview');
    }

    public function destroy(Request $request)
    {
        $overview = BerandaOverview::find($request->id);
        $overview->delete();
        return redirect()->route('admin.beranda-overview.beranda-overview');
    }

    public function edit($id)
    {
        $overview = BerandaOverview::find($id);
        $overviewCount = BerandaOverview::count();
        return view('admin.beranda_overview.edit', [
            'overview' => $overview,
            'overviewCount' => $overviewCount
        ]);
    }

    public function update(Request $request)
    {
        $overview = BerandaOverview::find($request->id);
        $overview->fill($request->input());
        $overview->save();
        return redirect()->route('admin.beranda-overview.beranda-overview'); 
    }
}