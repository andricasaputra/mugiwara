@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Tambah data fasilitas</h4>
                    <hr>
                    @include('inc.message')
                    <form  method="post" action="{{ route('facilities.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_type" value="facility">
                        <div class="form-group">
                            <label for="name">Nama fasilitas</label>
                            <input name="name" type="text" class="form-control form-control-lg"  required value="{{ old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi (optional)</label>
                            <textarea name="description" id="" cols="30" rows="2" class="form-control form-control-lg">{{ old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="name">upload Icon</label>
                            <input name="image" type="file" class="form-control form-control-lg"  required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('facilities.index') }}" class="btn btn-danger">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection();