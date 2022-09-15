
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
                <form action="{{ route('admin.product.redeem.list.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                     <input type="hidden" name="redeem_type" value="{{ $redeem->redeem_type }}">
                    @if($redeem->redeem_type == 'pickup')

                        <label for="photo_pickup">Status</label>
                       <select name="status" class="form-control">
                            <option value="">Belum diambil</option>
                            <option value="1">Sudah diambil</option>
                       </select>

                         <label for="photo_pickup">Foto Pengambilan Ditempat</label>
                        <input type="file" name="photo_pickup" class="form-control">

                    @else

                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="">Belum dikirim</option>
                            <option value="1">Sudah dikirim</option>
                        </select>

                        <label for="photo_deliveryd">Foto Resi</label>
                        <input type="file" name="photo_delivery" class="form-control">
                    @endif

                     <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
               
                <a href="{{ route('admin.product.redeem.list') }}" class="btn btn-sm btn-danger">Kembali</a>
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

