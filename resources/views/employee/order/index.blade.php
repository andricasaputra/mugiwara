@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                   {{--  <a href="{{ route('employee.order.point.create') }}" class="btn btn-success">Tambah Setting Poin</a> --}}
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Daftar Pemesanan</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Kode Booking</th>
                                                <th>Tanggal Pesan</th>
                                                <th>Akomodasi</th>
                                                <th>Customer</th>
                                                <th>Check In</th>
                                                <th>Harga Per Malam</th>
                                                <th>Diskon</th>
                                                <th>Status Pembayaran</th>
                                                <th>Jumlah Pembayaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($orders as $order)
                                                <tr>

                                                    <td>{{ $order->id }}</td>

                                                    <td>{{ $order->booking_code }}</td>

                                                    <td>
                                                    	{{ $order->created_at->format('d-m-Y') }} 
                                                    </td>

                                                    <td>
                                                    	{{ $order->accomodation?->name }} 

                                                    	<br>

                                                    	Tipe : <b>{{ $order->room?->type?->name }}</b>
                                                    </td>

                                                    <td>
                                                    	{{ ucfirst($order->user?->name) }} 
                                                    	<br>
                                                    	{{ $order->user?->email }} 
                                                    </td>

                                                    <td>
                                                    	{{ \Carbon\Carbon::parse($order->check_in_date)->format('d-m-Y') }} 
                                                    	<br>
                                                    	{{ $order->stay_day }} Hari 
                                                    </td>

                                                     <td>
                                                    	{{ $order->room?->price }} 
                                                    </td>


                                                    <td>
                                                    	@if($order->room?->discount_type == 'percent')
                                                            {{ $order->room?->discount_amount ?? 0 }} %
                                                        @else
                                                            {{ $order->room?->discount_amount ?? 0 }}
                                                        @endif
                                                    </td>

                                                    <td>
                                                    	@if($order->refund)

                                                    		<b style="color: red">Refund</b>

                                                    		<br>

                                                    		status : {{ $order->refund?->status }}
                                                    	@else
                                                    		{{ $order->payment?->status ?? 'Belum Dibayar' }}
                                                    	@endif 
                                                    </td>

                                                     <td>
                                                     	Rp {{ $order->payment?->amount ?? 0 }} 
                                                     </td>

                                                    <td>
                                                    	<a href="{{ route('employee.order.detail', $order->id) }}" class="btn btn-primary mb-2">Detail</a>

                                                        @if($order->order_status == 'completed')

                                                        	<button class="btn btn-success mt-2">Selesai</button>

                                                        @elseif($order->refund)
                                                        	<button class="btn btn-danger mt-2">Pengajuan Refund</button>
                                                        @else
                                                        	
                                                        	@if($order->order_status == 'booked')

                                                                    <a href="{{ route('employee.order.checkin.page', $order->id) }}" class="btn btn-success mb-2" data-order_id="{{ $order->id }}">Check In</a>


                                                                @elseif($order->order_status == 'stayed')

                                                                        <form action="{{ route('employee.order.checkout') }}" method="post">

                                                                        @csrf

                                                                        <input type="hidden" value="checkout" name="status">

                                                                        <input type="hidden" value="{{ $order->id }}" name="order_id">

                                                                        <button type="submit" class="btn btn-danger mt-2">Checkout</button>

                                                                @endif

                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="11">No order available</td> 
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