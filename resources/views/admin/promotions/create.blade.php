
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Promoosi</h4>
            <form action="{{ route('admin.promotion.store') }}" enctype="multipart/form-data" method="post">
                @csrf

                <div class="form-group">
                    <label for="name">Promo untuk penginapan</label>
                    <select name="accomodation_id" class="form-control" id="accomodation">
                        @foreach($accomodations as $accomodation)
                            <option value="{{ $accomodation->id }}">{{ $accomodation->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group"  id="room_container">
                    <label for="room_id">No Kamar</label>
                    <select name="room_id[]" id="room_id" class="form-control js-example-tags" multiple></select>
                </div>
                
                <div class="form-group">
                    <label for="name">Nama Promo</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi (optional)</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control" name="promotion_image" value="{{ old('image') }}" id="promotion_image" required>
                </div>

                 <div class="form-group">
                    <label for="name">Judul</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                </div>

                 <div class="form-group">
                    <label for="name">Judul</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                </div>

                
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.promotion.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {

        $(".js-example-tags").select2({
          tags: true
        });

    });

    $(document).on('change', '#accomodation', function(){

        const id = $(this).val();
        const container = $('#room_id');

        $.ajax({
            url : `{{ route('api.rooms.list') }}`,
            method : "POST",
            headers:{
                'X-CRSF-TOKEN' : '{{ csrf_token() }}'
            },
            data : {
                id : id
            },
            success : function(res){

                $.each(res, function (key, val) {
                    container.append(roomTemplater(val))
                });

            } 
        });

        function roomTemplater(data)
        {
            return `
                <option value="${data.id}">${data.room_number}</option>
            `;
        }

        
    });

</script>

@endsection

@section('link')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />

<style>
    .select2-selection__rendered {
    line-height: 10px !important;
    border-radius: 0 !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
    border-radius: 0 !important;
}
.select2-selection__arrow {
    height: 34px !important;
    border-radius: 0 !important;
}
</style>

@endsection

