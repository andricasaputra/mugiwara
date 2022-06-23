
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
            <h4 class="card-title">Form Ubah Sub Kantor Hotel</h4>
            <form action="{{ route('admin.hotel_sub_office.update') }}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="{{ $hotelSubOffice->id }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="mobile_number">Nomor Telepon</label>
                            <input type="number" class="form-control" id="mobile_number" name="mobile_number" value="{{ $hotelSubOffice->mobile_number }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="type">Tipe</label>
                            <input type="text" max="5" min="1" class="form-control" id="type" name="type" value="{{ $hotelSubOffice->type }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{ $hotelSubOffice->address }}</textarea>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <a href="{{ route('admin.hotel_sub_office.index', $hotelSubOffice->hotel_office_id) }}" class="btn btn-light">Kembali</a>
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