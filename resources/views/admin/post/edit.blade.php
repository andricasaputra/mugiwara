
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Berita</h4>
            <form action="{{ route('admin.post.update') }}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="{{ $post->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
                </div>
                <div class="form-group">
                    <label for="body">Isi</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ $post->body }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Gambar <small>Optional | Isi jika ingin diubah</small></label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="">~ Pilih Status ~</option>
                        <option value="1" {{ $post->is_active == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $post->is_active == '0' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.post.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

