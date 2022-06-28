
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Detail Berita</h4>
            <div class="card-body">
                <table class="display expandable-table table-striped" style="width:100%">
                    <tr>
                        <td>Judul</td>
                        <td>:</td>
                        <td>{{ $post->title }}</td>
                    </tr>
                    <tr>
                        <td>Slug</td>
                        <td>:</td>
                        <td>{{ $post->slug }}</td>
                    </tr>
                    <tr>
                        <td>Isi</td>
                        <td>:</td>
                        <td>{{ $post->body }}</td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td>:</td>
                        <td><a href="{{ Storage::disk('local')->url('data/'. $post->image) }}" target="_blank"><img src="{{ Storage::disk('local')->url('data/'. $post->image) }}" style="height:100px;width:100px;border-radius:0;"></a></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{ $post->is_active == '1' ? 'Aktif' : 'Non-aktif' }}</td>
                    </tr>
                </table>
                <br>
                <a href="{{ route('admin.post.index') }}" class="btn btn-sm btn-danger">Kembali</a>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

