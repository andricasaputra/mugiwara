@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    <div class="row">

                      <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card" style="border: 1px solid violet;">
                          <div class="card-body">
                            <p class="mb-4 font-weight-bold">Saldo Masuk (Via Aplikasi)</p>
                            <p class="fs-30 mb-2">Rp @currency($balance_in_total)</p>
                            {{-- <p>10.00% (30 days)</p> --}}
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card" style="border: 1px solid violet;">
                          <div class="card-body">
                            <p class="mb-4 font-weight-bold">Saldo Masuk Cash (Via Offline)</p>
                            <p class="fs-30 mb-2">Rp @currency($balance_in_offline_total)</p>
                            {{-- <p>10.00% (30 days)</p> --}}
                          </div>
                        </div>
                      </div>

                      <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card" style="border: 1px solid violet;">
                          <div class="card-body">
                            <p class="mb-4 font-weight-bold">Total Bookings</p>
                            <p class="fs-30 mb-2">{{ $bookings }} Kali</p>
                            {{-- <p>22.00% (30 days)</p> --}}
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card" style="border: 1px solid violet;">
                          <div class="card-body">
                            <p class="mb-4 font-weight-bold">Saldo Xendit</p>
                            <p class="fs-20 mb-2">{{ $balance_xendit }}</p>
                            {{-- <p>10.00% (30 days)</p> --}}
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card" style="border: 1px solid violet;">
                          <div class="card-body">
                            <p class="mb-4 font-weight-bold">Saldo Keluar</p>
                            <p class="fs-30 mb-2">Rp @currency($balance_out_total->sum('amount'))</p>
                            {{-- <p>22.00% (30 days)</p> --}}
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4 mb-4 stretch-card transparent">
                        <div class="card" style="border: 1px solid violet;">
                          <div class="card-body">
                            <p class="mb-4 font-weight-bold">Total Saldo</p>
                            <p class="fs-30 mb-2">Rp @currency($balance_in_total - $balance_out_total->sum('amount'))</p>
                            {{-- <p>22.00% (30 days)</p> --}}
                          </div>
                        </div>
                      </div>
                    </div>

                    <hr>
                        <div>
                            <form class="form-inline" action="{{ route('admin.payment.export.excel') }}" method="post">
                              <div class="form-group mb-2">
                                @csrf
                                <label for="from" class="sr-only">Dari</label>
                                <input type="date" class="form-control-plaintext" name="from" required>
                              </div>
                              <div class="form-group mx-sm-3 mb-2">
                                <label for="to" class="sr-only">Sampai</label>
                                <input type="date" class="form-control" name="to" required>
                              </div>
                              <button type="submit" class="btn btn-primary mb-2">Export Excel</button>
                            </form>
                        </div>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Keuangan</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>User</th>
                                                <th>Jumlah Pembayaran</th>
                                                <th>Voucher</th>
                                                <th>Pajak</th>
                                                <th>Status Pembayaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($payments as $payment)
                                                <tr>

                                                    <td>{{ $payment->order_id }}</td>

                                                    <td>
                                                        {{ ucfirst($payment->user?->name) }} 

                                                        <br>

                                                        {{ $payment->user?->email }}
                                                    </td>

                                                    <td>{{ $payment->amount }} </td>

                                                    <td>
                                                        {{  $payment->voucher?->name ?? '-' }}

                                                        <br>

                                                        @if($payment->voucher?->name != null)

                                                             Point yang dibutuhkan : {{ $payment->voucher?->point_needed   }}

                                                        @endif

                                                       

                                                        <br>

                                                         @if($payment->voucher?->discount_type == 'percent')

                                                          Diskon  : {{ $payment->voucher?->discount_percent }}%  

                                                        @elseif($payment->voucher?->discount_type == 'fixed')

                                                         Diskon : Rp {{ $payment->voucher?->discount_amount }}  

                                                        @endif

                                                       
                                                    </td>

                                                    {{-- <td>{{ $payment->discount_amount ?? '0' }} </td> --}}

                                                    <td>{{ $payment->tax ?? '0' }} </td>

                                                    <td>{{ $payment->status }} </td>

                                                    <td>

                                                        <a href="{{ route('admin.finance.detail', $payment->id) }}" class="btn btn-success mb-2">Detail</a>

                                                        <a href="{{ route('admin.finance.invoices', $payment->id) }}" class="btn btn-primary" target="_blank">Invoice</a>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8">No settings available</td> 
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
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

        $('#mytable').DataTable({
            order : false
        });
    </script>
@endsection()