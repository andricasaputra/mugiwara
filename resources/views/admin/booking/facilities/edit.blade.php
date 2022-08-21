@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Edit data fasilitas</h4>
                    <hr>
                    @include('inc.message')
                    <form  method="post" action="{{ route('facilities.update', $facility->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="image_type" value="facility">

                        <div class="form-group">
                            <label for="name">Nama fasilitas</label>
                            <input name="name" type="text" class="form-control form-control-lg"  required value="{{ $facility->name }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi (optional)</label>
                            <textarea name="description" id="" cols="30" rows="2" class="form-control form-control-lg">{{ $facility->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <div style="padding: 0 100px" class="d-flex justify-content-start">
                                <img src="{{ asset('storage/facilities/') . '/' . $facility->image }}" alt="icon">
                            </div>
                            <label for="name">upload Icon</label>
                            <input name="image" type="file" class="form-control form-control-lg">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('facilities.index') }}" class="btn btn-danger">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()