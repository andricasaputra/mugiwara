
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Upload Bukti</h4>
            <div class="card-body">
                <form action="{{ route('admin.product.redeem.list.update', $redeem->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <input type="hidden" name="redeem_type" value="{{ $redeem->redeem_type }}">
                    @if($redeem->redeem_type == 'pickup')

                        <label for="photo_pickup">Status</label>
                       <select name="status" class="form-control">
                            <option value="">Belum diambil</option>
                            <option value="1">Sudah diambil</option>
                       </select>

                         <label for="photo_pickup">Foto Pengambilan Ditempat</label>
                         <div>
                            <img src="{{ url('storage/products/pickups/' . $redeem?->image?->image) }}" alt="" width="100">
                        </div>
                        <input type="file" name="photo_pickup" class="form-control">

                    @else

                        <label for="jenis_pengiriman">Jenis Pengiriman</label>
                        <input type="text" name="jenis_pengiriman" class="form-control" required value="{{ $redeem->jenis_pengiriman }}">

                        <label for="no_resi">Nomor Resi</label>
                        <input type="text" name="no_resi" class="form-control" required value="{{ $redeem->no_resi }}">

                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="" {{ $redeem->status == null ? '' : 'selected' }}>Belum dikirim</option>
                            <option value="1" {{ $redeem->status == 1 ? 'selected' : '' }}>Sudah dikirim</option>
                        </select>

                        <label for="photo_deliveryd">Foto Resi</label>
                        <div>
                            <img src="{{ url('storage/products/deliverys/' . $redeem?->image?->image) }}" alt="" width="100">
                        </div>
                        <input type="file" name="photo_delivery" class="form-control" >
                    @endif

                    <div class="d-flex justify-content-center">

                        <a href="{{ route('admin.product.redeem.list') }}" class="btn btn-sm btn-danger mt-3 mr-3">Kembali</a>

                        <button type="submit" class="btn btn-sm btn-primary mt-3">Submit</button>
                        
                    </div>

                    
                </form>
               
                
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#discount_type').on('change', function() {
        if($(this).val() == 'fixed'){
            console.log($('#containerPercent').find('input'));
            $('#containerFixed').removeClass('d-none');
            $('#containerPercent').addClass('d-none');
            $('#containerFixed').find('input').prop('required', true);
            $('#containerFixed').find('input').val('');
            $('#containerPercent').find('input').prop('required', false);
        }else{
            $('#containerPercent').removeClass('d-none');
            $('#containerFixed').addClass('d-none');
            $('#containerPercent').find('input').prop('required', true);
            $('#containerPercent').find('input').val('');
            $('#containerFixed').find('input').prop('required', false);
        }
    });
</script>
@endpush

