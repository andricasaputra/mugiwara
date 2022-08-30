
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">CheckIn Pesanan Order ID {{ $order->id }}</h4>
            <div class="card-body">
                <table class="display expandable-table table-striped" style="width:100%">

                    <h4>Informasi Tamu</h4>

                    <tr>
                        <td>Nama Tamu</td>
                        <td>:</td>
                        <td>{{ ucwords($order->user?->name) }}</td>
                    </tr>

                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $order->user?->email }}</td>
                    </tr>

                    <tr>
                        <td>No Handpone</td>
                        <td>:</td>
                        <td>{{ $order->user?->mobile_number }}</td>
                    </tr>

                    <tr>
                        <td>Order Id</td>
                        <td>:</td>
                        <td>{{ $order->id }}</td>
                    </tr>

                    <tr>
                        <td>Kode Booking</td>
                        <td>:</td>
                        <td>{{ $order->booking_code }}</td>
                    </tr>

                    <tr>
                        <td>Nama Penginapan</td>
                        <td>:</td>
                        <td>{{ $order->accomodation?->name }}</td>
                    </tr>

                    <tr>
                        <td>Nomor Kamar</td>
                        <td>:</td>
                        <td>{{ $order->room?->room_number }}</td>
                    </tr>

                     <tr>
                        <td>Tipe Kamar</td>
                        <td>:</td>
                        <td>{{ $order->room?->type?->name }}</td>
                    </tr>

                    <tr>
                        <td>Lama Menginap</td>
                        <td>:</td>
                        <td>{{ $order->stay_day }} Hari</td>
                    </tr>

                    <tr>
                        <td>Harga Per Malam</td>
                        <td>:</td>
                        <td>{{ $order->room?->price }}</td>
                    </tr>

                    <tr>
                        <td>Diskon Kamar</td>
                        <td>:</td>
                        <td>{{ $order->room?->discount_amount ?? 0 }}</td>
                    </tr>

                    <tr>
                        <td>Diskon Voucher</td>
                        <td>:</td>
                        <td>{{ $order->voucher?->point_needed ?? 0 }}</td>
                    </tr>

                    <tr>
                        <td>Pajak</td>
                        <td>:</td>
                        <td>{{ $order->payment?->tax ?? 0 }}</td>
                    </tr>

                    <tr>
                        <td>Total Pembayaran</td>
                        <td>:</td>
                        <td>Rp @currency($order->payment?->amount)</td>
                    </tr>
                </table>

                <br>

                <div class="d-flex justify-content-center">
                    <a href="{{ route('employee.order.index') }}" class="btn btn-sm btn-danger mr-2">Kembali</a>
                    <form action="{{ route('employee.order.checkin') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <button type="submit" class="btn btn-success"><b>Check In</b></button>
                    </form>
                </div>
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

