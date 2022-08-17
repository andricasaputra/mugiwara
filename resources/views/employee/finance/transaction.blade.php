@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                	<div class="row">
				      <div class="col-md-6 mb-4 stretch-card transparent">
				        <div class="card card-tale">
				          <div class="card-body">
				            <p class="mb-4">Saldo Xendit</p>
				            <p class="fs-30 mb-2">1234567</p>
				            <p>10.00% (30 days)</p>
				          </div>
				        </div>
				      </div>
				     {{--  <div class="col-md-6 mb-4 stretch-card transparent">
				        <div class="card card-dark-blue">
				          <div class="card-body">
				            <p class="mb-4">Total Bookings</p>
				            <p class="fs-30 mb-2">61344</p>
				            <p>22.00% (30 days)</p>
				          </div>
				        </div>
				      </div>
				    </div> --}}

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

@section('link')
    <style>
        .pagination {
          display: inline-block;
        }

        .pagination a {
          color: black;
          float: left;
          padding: 8px 16px;
          text-decoration: none;
        }

        .pagination a.active {
          background-color: #4CAF50;
          color: white;
          border-radius: 5px;
        }

        .pagination a:hover:not(.active) {
          background-color: #ddd;
          border-radius: 5px;
        }
</style>
@endsection



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

    </script>
@endsection()