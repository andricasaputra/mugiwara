<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::when(request()->q, function($types) {
            $types->where('name', 'like', '%'.request()->q.'%');
        })->paginate(10);
        return view('admin.type.index', compact('types'));
    }
    public function create()
    {
        return view('admin.type.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        Type::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.type.index')->with('success', 'Data tipe ruangan berhasil ditambahkan');
    }
    
    public function edit($typeId)
    {
        $type = Type::find($typeId);
        return view('admin.type.edit', compact('type'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $type = Type::find($request->id);
        $type->update([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.type.index')->with('success', 'Data tipe ruangan berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $type = Type::find($request->id);
        $type->delete();
        return redirect()->route('admin.type.index')->with('success', 'Data tipe ruangan berhasil dihapus');
    }
}
