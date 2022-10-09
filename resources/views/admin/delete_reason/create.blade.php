
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Data Alasan Hapus Akun</h4>
            <form action="{{ route('admin.delete_reason.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="reason">Alasan</label>
                    <input type="text" class="form-control"  name="reason" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi (optional)</label>
                    <textarea name="description" class="form-control" cols="30" rows="10"></textarea>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.delete_reason.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

