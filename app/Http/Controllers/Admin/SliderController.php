<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::when(request()->q, function($sliders) {
            $sliders->where('title', 'like', '%'.request()->q.'%')->orWhere('order', 'like', '%'.request()->q.'%');
        })->paginate(10);
        return view('admin.slider.index', compact('sliders'));
    }
    public function create()
    {
        return view('admin.slider.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'order' => 'required',
            'is_active' => 'required',
            'expired_date' => 'required',
            'image' => 'required|image',
            'description' => 'required'
        ]);
        if($request->image){
            $img = $request->file('image');
            $size = $img->getSize();
            $namaImage = time() . "_" . $img->getClientOriginalName();
            Storage::disk('public')->put('data/'.$namaImage, file_get_contents($img->getRealPath()));
        }
        Slider::create([
            'user_id' => auth()->user()->id,
            'image' => $namaImage,
            'order' => $request->order,
            'title' => $request->title,
            'description' => $request->description,
            'expired_date' => $request->expired_date,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('admin.slider.index')->with('success', 'Data slider berhasil ditambahkan');
    }
    
    public function edit($sliderId)
    {
        $slider = Slider::find($sliderId);
        return view('admin.slider.edit', compact('slider'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'order' => 'required',
            'is_active' => 'required',
            'expired_date' => 'required',
            'image' => 'sometimes|image',
        ]);
        $slider = Slider::find($request->id);
        if($request->image){
            Storage::disk('public')->delete('data/'.$slider->image);
            $img = $request->file('image');
            $size = $img->getSize();
            $namaImage = time() . "_" . $img->getClientOriginalName();
            Storage::disk('public')->put('data/'.$namaImage, file_get_contents($img->getRealPath()));
        }
        $slider->update([
            'user_id' => auth()->user()->id,
            'image' => $namaImage ?? $slider->image,
            'order' => $request->order,
            'title' => $request->title,
            'description' => $request->description,
            'expired_date' => $request->expired_date,
            'is_active' => $request->is_active,
        ]);
        return redirect()->route('admin.slider.index')->with('success', 'Data slider berhasil diubah');
    }
    
    public function delete(Request $request)
    {
        $slider = Slider::find($request->id);
        Storage::disk('public')->delete('data/'.$slider->image);
        $slider->delete();
        return redirect()->route('admin.slider.index')->with('success', 'Data slider berhasil dihapus');
    }
}
