@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Edit data kategori</h4>
                    <hr>
                    @include('inc.message')
                    <form  method="post" action="{{ route('room_types.update', $room_type->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama Kategori</label>
                            <input name="name" type="text" class="form-control form-control-lg"  required value="{{ $room_type->name }}">
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi (optional)</label>
                            <textarea name="description" id="" cols="30" rows="2" class="form-control form-control-lg">{{ $room_type->descrition }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('room_types.index') }}" class="btn btn-danger">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()