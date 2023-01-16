@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Tambah data nomor kamar</h4>
                    <hr>
                    @include('inc.message')
                    <form  method="post" action="{{ route('room_numbers.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="number">Nomor kamar</label>
                            <input name="number" type="text" class="form-control form-control-lg"  required value="{{ old('number') }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('room_numbers.index') }}" class="btn btn-danger">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()