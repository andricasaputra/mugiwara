
@extends('layouts.main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Edit Pesanan Order ID {{ $order->id }}</h4>
            <form action="{{ route('employee.order.update', $order->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="accomodation_id">Nama Tamu</label>
                            <input type="text" class="form-control" name="accomodation_id" value="{{ $order->user?->name }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="accomodation_id">Nama Penginapan</label>
                            <input type="text" class="form-control" name="accomodation_id" value="{{ $order->accomodation?->name }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="room_type">Tipe Kamar Saat Ini</label>
                            <input type="text" class="form-control" name="room_type" value="{{ $order->room?->type?->name }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="room_id_old">Nomor Kamar Saat Ini</label>
                            <input type="text" class="form-control" name="room_id_old" value="{{ $order->room?->room_number }}" readonly>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="accomodation_id">Ganti Ke Nomor</label>
                           <select name="room_id" name="room_id" class="form-control">
                               @foreach($rooms as $room)

                                <option value="{{ $room->id }}">{{ $room->room_number }}</option>

                               @endforeach
                           </select>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('employee.order.index') }}" class="btn btn-light">Kembali</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
    $('#ratings').keypress(function(event){
        event.preventDefault();
    });
</script>
@endpush