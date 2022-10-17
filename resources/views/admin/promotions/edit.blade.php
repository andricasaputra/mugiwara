
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
            <form action="{{ route('admin.promotion.update', $promotion->id) }}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Promo untuk penginapan</label>
                    <select name="accomodation_id" class="form-control" id="accomodation">
                        <option value="{{ $promotion->accomodation?->id }}">{{ $promotion->accomodation?->name }}</option>
                        @foreach($accomodations as $accomodation)
                            <option value="{{ $accomodation->id }}">{{ $accomodation->name }}</option>
                        @endforeach
                    </select>
                </div>

                  <div class="form-group"  id="type_container">
                    <label for="room_id">Tipe Kamar & Nomor Kamar</label>
                    <select name="type" id="type" class="form-control" >
                        <option value="{{ $promotion->room_type }}-{{ $promotion->room_number }}">{{ $promotion->room_type }} - {{ $promotion->room_number }}</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $promotion->name }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Deskripsi (optional)</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $promotion->description }}</textarea>
                </div>

                 <div class="form-group">
                    <label for="name">Waktu Mulai</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $promotion->start_date }}" required>
                </div>

                 <div class="form-group">
                    <label for="name">Waktu Selesai</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $promotion->end_date }}" required>
                </div>

                
                <div class="form-group">
                    <label for="is_active">Status</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                       @if($promotion->is_active == 'Aktif')
                            <option value="1">Aktif</option>
                             <option value="">Tidak Aktif</option>
                       @else
                            <option value="">Tidak Aktif</option>
                             <option value="1">Aktif</option>
                       @endif
                      
                      
                    </select>
                </div>

                 <div class="form-group">
                    <label for="image">Ganti Gambar</label>

                    <div>
                        <img src="{{ asset('storage/promotions/' . $promotion->images->first()->image) }}" alt="promotion" width="200">
                    </div>

                    <input type="file" class="form-control" name="promotion_image" id="promotion_image">
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
        const type_container = $('#type');

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


                console.log(res);

                $.each(res, function (key, val) {
                    //container.append(roomTemplater(val))
                    type_container.append(typeTemplater(val))
                });

            } 
        });

        function roomTemplater(data)
        {
            return `
                <option value="${data.id}">${data.room_number}</option>
            `;
        }

        function typeTemplater(data)
        {
            return `
                <option value="${data.type.name}-${data.room_number}">${data.type.name} - ${data.room_number}</option>
            `;
        }

        
    });

</script>

@endsection

