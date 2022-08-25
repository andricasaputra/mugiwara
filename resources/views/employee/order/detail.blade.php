@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-5 col-sm-12">
            <div class="card">
                <div class="card-header">Metofe Pembayaran</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
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
                                <td>Jumlah Pembayaran</td>
                                <td>:</td>
                                <td>{{ $order->payment?->amount }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-sm-12">
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
                                <td>{{ $order->payment?->voucher?->discount_amount }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
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