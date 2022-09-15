
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
                        <td>Nama Produk</td>
                        <td>:</td>
                        <td>{{ $product->product->name }}</td>
                    </tr>
                    <tr>
                        <td>Nama Penukar</td>
                        <td>:</td>
                        <td>{{ $product->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Email Penukar</td>
                        <td>:</td>
                        <td>{{ $product->user->email }}</td>
                    </tr>
                    <tr>
                        <td>No HP Penukar</td>
                        <td>:</td>
                        <td>{{ $product->user->mobile_number }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Penukaran</td>
                        <td>:</td>
                        <td>{{ $product->created_at->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Foto Produk</td>
                        <td>:</td>
                        <td>
                            <img src="{{ url('storage/products/' . $product?->product?->image?->image) }}" alt="product"  width="100">
                        </td>
                    </tr>
                    <tr>
                        <td>Foto Pengambilan/No Resi</td>
                        <td>:</td>
                        <td>

                            @if($product?->image?->image == NULL)
                                Bukti Pengambilan/Pengiriman Belum Terbit
                            @else
                                @if($product->redeem_type == 'pickups')
                                    <img src="{{ url('storage/products/pickups/' . $product?->image?->image ) }}" alt="bukti" width="100">
                                @else
                                    <img src="{{ url('storage/products/deliverys/' . $product?->image?->image) }}" alt="bukti" width="100">
                                @endif
                            @endif

                            
                        </td>
                    </tr>
                </table>
                <br>
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

