@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header">Metode Pembayaran</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Tipe Pembayaran</td>
                                <td>:</td>
                                <td>{{ $order->payment?->payable_type == 'App\Models\Payments\VirtualAccount' ? 'Virtual Account' : 'Ewallet' }}</td>
                            </tr>
                            <tr>
                                <td>Metode Pembayaran</td>
                                <td>:</td>
                                <td>{{ $order->payment?->payable_type == 'App\Models\Payments\Ewallet' ? $order->payment?->payable?->channel_code : $order->payment?->payable?->bank_code }} </td>
                            </tr>
                            
                            <tr>
                                <td>Waktu Bayar</td>
                                <td>:</td>
                                <td>{{ $order->payment?->payable?->payment_time }}</td>
                            </tr>
                            <tr>
                                <td>Diskon Kamar</td>
                                <td>:</td>
                                <td>{{ $order->room?->discount_amount ?? 0 }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Pembayaran</td>
                                <td>:</td>
                                <td>@currency($order->payment?->amount)</td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>:</td>
                                <td>{{ $order->payment?->status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header">Informasi Kamar Yang Dipesan</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <td>Nama Penginapan</td>
                                <td>:</td>
                                <td>{{ ucwords($order->accomodation?->name) }} </td>
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
                                <td>Check In</td>
                                <td>:</td>
                                <td>{{ $order->check_in_date }}</td>
                            </tr>
                            <tr>
                                <td>Check Out</td>
                                <td>:</td>
                                <td>{{ $order->check_out_date }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{ $order->room?->status }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5 col-sm-12">
            <div class="card">
                <div class="card-header">Informasi Tamu</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                    
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ ucwords($order->user?->name) }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{ $order->user?->email }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Handpone</td>
                                <td>:</td>
                                <td>{{ $order->user?->mobile_number }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

          <div class="col-lg-6 col-sm-12">
            <div class="card">
                <div class="card-header">Informasi Voucher</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="user-table" class="display expandable-table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama Voucher</th>
                                    <th>Deskripsi</th>
                                    <th>Diskon</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{ $order->payment?->voucher?->name }}</td>
                                    <td>{{ $order->payment?->voucher?->description }}</td>
                                    <td>{{ $order->payment?->voucher?->discount_type == 'percent' ? $order->payment?->voucher?->discount_percent . '%' : $order->payment?->voucher?->discount_amount }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('scripts')
    <script>
        $('.confirm').on('click', function (e) {
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                return true;
            }
            else {
                return false;
            }
        });

        $('#user-table').DataTable();
    </script>
@endsection()