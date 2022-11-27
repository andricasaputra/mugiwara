create
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Edit Setting Pop Up</h4>
            <form action="{{ route('admin.settings.popup.update', $popup->id) }}" method="post" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control"  name="title" required value="{{ $popup->title }}">
                </div>

                <div class="form-group">
                    <label for="description">Keterangan</label>
                   <textarea name="description" cols="30" rows="10" class="form-control">{{ $popup->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="is_active">Is Active</label>
                    <select name="is_active" class="form-control">

                        @if($popup->is_active)

                        <option value="{{ $popup->is_active }}">{{ $popup->is_active == 1 ? 'Aktif' : 'Non Aktif' }}</option>
                        <option value="0">Non Aktif</option>

                        @else

                             <option value="{{ $popup->is_active }}">{{ $popup->is_active == 1 ? 'Aktif' : 'Non Aktif' }}</option>
                            <option value="1">Aktif</option>

                        @endif

                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <div>
                        <img src="{{ asset('storage/popups/' . $popup->image?->image) }}" alt="" width="100">
                    </div>
                    <input type="file" class="form-control"  name="image">
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.promotion.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection


