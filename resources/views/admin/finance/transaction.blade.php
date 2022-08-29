@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    <div class="row">

                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <div class="row d-flex align-items-center">
                                    <div class="col-6">
                                    <p class="card-title">Daftar Transaksi Xendit</p>
                                </div>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Transaksi ID</th>
                                                <th>Channel Category</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Kode Booking</th>
                                                <th>Nomor HP</th>
                                                <th>Jumlah Pembayaran</th>
                                                <th>Jumlah Pembayaran Net</th>
                                                <th>Status Pembayaran</th>
                                                <th>Cashflow</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($transactions['data'] as $transaction)
                                                <tr>

                                                    <td>{{ $transaction['id'] }}</td>

                                                    <td>
                                                        {{ $transaction['channel_category'] }} 
                                                    </td>

                                                    <td>{{ $transaction['channel_code'] }} </td>

                                                    <td>
                                                        {{ $transaction['reference_id'] }}
                                                    </td>

                                                    <td>{{ $transaction['account_identifier'] }} </td>

                                                    <td>{{ $transaction['amount'] }} </td>


                                                    <td>{{ $transaction['net_amount'] }} </td>

                                                    <td>{{ $transaction['settlement_status'] }} </td>

                                                    <td>{{ $transaction['cashflow'] }} </td>

                                                    <td>

                                                        <a href="{{ route('admin.finance.transaction.detail', $transaction['id']) }}" class="btn btn-success">Detail</a>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="10">No settings available</td> 
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    <div class="pagination">
                                      <a href="{{ $prevlink ?? '#' }}">&laquo;</a>
                                      <a href="#">{{ $pages }}</a>
                                      <a href="{{ $nextlink ?? '#' }}">&raquo;</a>
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
</div>
   
@endsection
