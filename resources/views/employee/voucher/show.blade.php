
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Detail Voucher</h4>
            <div class="card-body">
                <table class="display expandable-table table-striped" style="width:100%">
                    <tr>
                        <td>Kode Voucher</td>
                        <td>:</td>
                        <td>{{ $voucher->code }}</td>
                    </tr>
                    <tr>
                        <td>Nama Voucher</td>
                        <td>:</td>
                        <td>{{ $voucher->name }}</td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td>{{ $voucher->description }}</td>
                    </tr>
                    <tr>
                        <td>Voucher Dapat Digunakan Untuk</td>
                        <td>:</td>
                        <td>Tukar {{ $voucher->type }}</td>
                    </tr>
                    <tr>
                        <td>Maksimal Penggunaan Voucher</td>
                        <td>:</td>
                        <td>{{ $voucher->max_uses }} x</td>
                    </tr>
                    <tr>
                        <td>Berapa kali pengguna dapat menggunakan voucher</td>
                        <td>:</td>
                        <td>{{ $voucher->max_uses_user }} x</td>
                    </tr>
                    <tr>
                        <td>Tipe Diskon</td>
                        <td>:</td>
                        <td>{{ $voucher->discount_type == 'fixed' ? 'Flat' : 'Persen' }}</td>
                    </tr>
                    <tr>
                        <td>Jumlah Diskon</td>
                        <td>:</td>
                        <td>{{ $voucher->discount_type == 'fixed' ? $voucher->discount_amount : $voucher->discount_percent.' %' }}</td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td>:</td>
                        <td><a href="{{ Storage::disk('public')->url('vouchers/'. $voucher->image) }}" target="_blank"><img src="{{ Storage::disk('public')->url('vouchers/'. $voucher->image) }}" width="200"></a></td>
                    </tr>
                    <tr>
                        <td>Voucher Berlaku Pada</td>
                        <td>:</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($voucher->starts_at)) }}</td>
                    </tr>
                    <tr>
                        <td>Voucher Berlaku Sampai</td>
                        <td>:</td>
                        <td>{{ date('d-m-Y H:i:s', strtotime($voucher->expires_at)) }}</td>
                    </tr>
                    <tr>
                        <td>Poin Yang Dibutuhkan</td>
                        <td>:</td>
                        <td>{{ $voucher->point_needed }} Poin</td>
                    </tr>
                </table>
                <br>
                <a href="{{ route('admin.voucher.index') }}" class="btn btn-sm btn-danger">Kembali</a>
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

