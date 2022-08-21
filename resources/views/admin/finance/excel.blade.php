<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
    	th{
    		font-weight: bold;
    	}
    </style>
  </head>
  <body>
  	<table>
  		<th>Data Pembayaran Dari Tanggal {{ $date->from }} Sampai {{ $date->to }}</th>
  	</table>
    <table>
      	<thead>
	        <tr>
	          <th>No</th>
	          <th>Order ID</th>
	          <th>User</th>
	          <th>Jumlah Pembayaran</th>
	          <th>Jumlah Diskon</th>
	          <th>Pajak</th>
	          <th>Status Pembayaran</th>
	          <th class="pl-0  pb-2 border-bottom">Kode Booking</th>
	          <th>Penginapan</th>
	          <th>Kamar</th>
	          <th>Tamu</th>
	          <th>Check In</th>
	          <th>Lama Menginap</th>
	          <th>Check out</th>
	          <th>Jumlah Tamu</th>
	          <th>Diskon</th>
	          <th>Voucher</th>
	          <th>Total Harga Setelah Diskon</th>
	          <th>Pesanan Dibuat Pada</th>
	        </tr>
      	</thead>
      	<tbody> 
      	@foreach ($payments as $key => $payment) 
	      	<tr>
	      		<td>{{ $key  + 1 }}</td>
	          <td>{{ $payment->order_id }}</td>
	          <td>
	            {{ ucfirst($payment->user?->name) }}
	            <br>
	            {{ $payment->user?->email }}
	          </td>
	          <td>{{ $payment->amount }} </td>
	          <td>{{ $payment->discount_amount ?? '0' }} </td>
	          <td>{{ $payment->tax ?? '0' }} </td>
	          <td>{{ $payment->status }} </td>
	          <td>{{ $payment->booking_code }}</td>
	          <td>{{ $payment->order?->accomodation?->name }}</td>
	          <td> Nomor : {{ $payment->order?->room?->room_number }} Tipe : {{ $payment->order?->room?->type->name }}
	          </td>
	          <td>{{ $payment->user->name }}</td>
	          <td>{{ $payment->order?->check_in_date }}</td>
	          <td>{{ $payment->order?->stay_day }}</td>
	          <td>{{ $payment->order?->check_out_date }}</td>
	          <td>{{ $payment->order?->total_guest }}</td>
	          <td>{{ $payment->order?->discount_amount }}</td>
	          <td>{{ $payment->voucher?->name ?? '-'}}</td>
	          <td>{{ $payment->order?->total_price }}</td>
	          <td>{{ $payment->order?->created_at }}</td>
	        </tr>
    		@endforeach
		</tbody>
    </table>
  </body>
</html>