@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                	<div class="row">
				      <div class="col-md-6 mb-4 stretch-card transparent">
				        <div class="card card-dark-blue">
				          <div class="card-body">
				            <p class="mb-4">Total Bookings</p>
				            <p class="fs-30 mb-2">{{ $bookings }} Kali</p>
				            {{-- <p>22.00% (30 days)</p> --}}
				          </div>
				        </div>
				      </div>
				    </div>

                    <hr>
                        <div>
                            <form class="form-inline" action="{{ route('employee.payment.export.excel') }}" method="post">
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
                                                <th>Jumlah Diskon</th>
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
                                                    	{{ $payment->voucher?->name ?? '-' }}

                                                    	<br>

                                                    	{{ $payment->voucher?->discount_amount }}  
                                                    </td>

                                                    <td>{{ $payment->discount_amount ?? '0' }} </td>

                                                    <td>{{ $payment->tax ?? '0' }} </td>

                                                    <td>{{ $payment->status }} </td>

                                                    <td>

                                                    	<a href="{{ route('employee.finance.detail', $payment->id) }}" class="btn btn-success mb-2">Detail</a>

                                                        <a href="{{ route('employee.finance.invoices', $payment->id) }}" class="btn btn-primary" target="_blank">Invoice</a>

                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">No settings available</td> 
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