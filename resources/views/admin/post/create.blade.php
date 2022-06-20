
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Berita</h4>
            <form action="{{ route('admin.post.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                </div>
                <div class="form-group">
                    <label for="body">Isi</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old('body') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control" name="image" value="{{ old('image') }}" id="image" required>
                </div>
                
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="">~ Pilih Status ~</option>
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Non-Aktif</option>
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

