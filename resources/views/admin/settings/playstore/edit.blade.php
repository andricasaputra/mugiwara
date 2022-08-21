
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Setting Play Store</h4>
            <form action="{{ route('admin.playstores.update', $playstore->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control"  name="name" required value="{{ $playstore->name }}">
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <input type="text" class="form-control"  name="description" required value="{{ $playstore->description }}">
                </div>


                 <div class="form-group">
                    <label for="url">Link</label>
                    <input type="text" class="form-control"  name="url" required value="{{ $playstore->url }}">
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.playstores.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection


