
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Slider</h4>
            <form action="{{ route('admin.slider.update') }}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="{{ $slider->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $slider->title }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $slider->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control" name="image" value="{{ $slider->image }}" id="image" required>
                </div>
                <div class="form-group">
                    <label for="order">Urutan Ke -</label>
                    <input type="number" class="form-control" name="order" value="{{ $slider->order }}" id="order" required>
                </div>
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="">~ Pilih Status ~</option>
                        <option value="1" {{ $slider->is_active == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $slider->is_active == '0' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

