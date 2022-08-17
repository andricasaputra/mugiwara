
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Promoosi</h4>
            <form action="{{ route('admin.promotion.update', $promotion->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $promotion->name }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi (optional)</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $promotion->description }}</textarea>
                </div>

                {{-- <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control" name="promotion_image" value="{{ $promotion->image }}" id="promotion_image" required>
                </div> --}}

                 <div class="form-group">
                    <label for="name">Judul</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $promotion->start_date }}" required>
                </div>

                 <div class="form-group">
                    <label for="name">Judul</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $promotion->end_date }}" required>
                </div>

                
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                       <option value="{{ $promotion->is_active }}">{{ $promotion->is_active }}</option>
                       <option value="1">Aktif</option>
                       <option value="2">Tidak Aktif</option>
                    </select>
                </div>

                 <div class="form-group">
                    <label for="image">Ganti Gambar</label>

                    <div>
                        <img src="{{ asset('storage/promotions/' . $promotion->images->first()->image) }}" alt="promotion" width="200">
                    </div>

                    <input type="file" class="form-control" name="promotion_image" id="promotion_image" required>
                </div>
                
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.promotion.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

