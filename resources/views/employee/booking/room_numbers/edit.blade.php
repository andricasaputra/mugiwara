@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Edit data nomor kamar</h4>
                    <hr>
                    @include('inc.message')
                    <form  method="post" action="{{ route('room_numbers.update', $number->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="number">Nomor kamar</label>
                            <input name="number" type="text" class="form-control form-control-lg"  required value="{{ $number->number }}">
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