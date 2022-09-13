
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
                <form action="{{ route('admin.product.redeem.list.upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                     <input type="hidden" name="redeem_type" class="form-control" value="{{ $redeem->redeem_type }}">
                    @if($redeem->redeem_type == 'pickup')
                        <label for="photo_pickup">Foto</label>
                        <input type="file" name="photo_pickup" class="form-control" required>
                    @else
                        <label for="photo_delivery">Foto</label>
                    <input type="file" name="photo_delivery" class="form-control" required>
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

