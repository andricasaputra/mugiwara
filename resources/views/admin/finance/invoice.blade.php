<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

<style>
	<style>
    <?php include(public_path().'/css/print.css');?>
</style>

	<style>
	*{
	    font-family: 'Helvetica';
	}

	.color1{
		color: '#3C241E';
	}

	.color2{
		color:  '#9E733E';
	}


	</style>
</head>
<body>
	<div class="col-sm-12" style="text-align: left">
		<img src="{{ public_path('assets/images/capsuleinnlogo.png') }}" alt="logo" width="80">
	</div>

	<div style="margin-top: 20px">
		<h1 style="font-weight: bold;" class="color1">Invoice</h1>
	</div>

	<div style="margin-top: 30px">
		<table style="width: 100%">
			<tr>
				<td style="width: 20%">Tanggal</td>
				<td style="width: 5%">:</td>
				<td style="width: 30%">{{ \Carbon\Carbon::parse($data['payable']['payment_time'])->format('d-m-Y') }}</td>
				<td style="width: 45%"><h3>{{ $data['order']['accomodation']['name'] }}</h3></td>
			</tr>

			<tr>
				<td style="width: 20%">Pembayaran</td>
				<td style="width: 5%">:</td>
				<td style="width: 30%">{{ $data['payable_type'] == 'App\Models\Payments\VirtualAccount' ? $data['payable']['bank_code'] . ' Virtual Account' : $data['payable']['channel_code'] }}</td>
				<td style="width: 45%"><div style="width: 100px; padding: 4px 1px; border: 1px solid #faa537; background-color: #f7f5f2; font-size: 10px; text-align: center; border-radius: 2px">{{ $data['order']['room']['type']['name'] }}</div></td>
			</tr>

			<tr>
				<td style="width: 20%">Kode Voucher</td>
				<td>:</td>
				<td>{{ is_null($data['voucher']) ? '-' : $data['voucher']['name'] }}</td>
				<td></td>
			</tr>

			<tr>
				<td style="width: 20%">Order ID</td>
				<td>:</td>
				<td><div style="width: 100px; padding: 4px 1px; border: 1px solid #fcba03; background-color: #f7f5f2; font-size: 10px; text-align: center; border-radius: 2px">{{ $data['order']['id'] }}</div></td>
				<td>{{ $data['order']['accomodation']['address'] }}</td>
			</tr>
		</table>
	</div>

	<div style="margin-top: 30px">
		<h4 style="font-weight: bold;" class="color1">Detail Pesanan</h4>
	</div>

	<div style="margin-top: 30px; border: 1px solid #faa537; background-color: #f7f5f2;border-radius: 5px">
		<table style="width: 100%; text-align: center">
			<tr>
				<td><p style="font-size: 11px">Nama Pemesan</p></td>
				<td><p style="font-size: 11px">Email</p></td>
				<td><p style="font-size: 11px">Nomor Telepon</p></td>
			</tr>

			<tr>
				<td><p style="color: #9E733E; font-weight: bold; font-size: 12px">{{ ucwords($data['user']['name']) }}</p></td>
				<td><p style="color: #9E733E; font-weight: bold; font-size: 12px">{{ $data['user']['email'] }}</p></td>
				<td><p style="color: #9E733E; font-weight: bold; font-size: 12px">{{ $data['user']['mobile_number'] }}</p></td>
			</tr>
		</table>
	</div>

	<div style="margin-top: 30px">
		<table style="width: 100%; text-align: center">
			<tr>
				<th><p style="font-size: 13px; background-color: #9E733E; color: #fff; padding: 10px 0">No</p></th>
				<th><p style="font-size: 13px; background-color: #9E733E; color: #fff; padding: 10px 0">Produk</p></th>
				<th><p style="font-size: 13px; background-color: #9E733E; color: #fff; padding: 10px 0">Harga</p></th>
				<th><p style="font-size: 13px; background-color: #9E733E; color: #fff; padding: 10px 0">Check In</p></th>
				<th><p style="font-size: 13px; background-color: #9E733E; color: #fff; padding: 10px 0">Check Out</p></th>
				<th><p style="font-size: 13px; background-color: #9E733E; color: #fff; padding: 10px 0">Tamu</p></th>
				<th><p style="font-size: 13px; background-color: #9E733E; color: #fff; padding: 10px 0">Total</p></th>
			</tr>

			<tr>
				<td style="color: #755731; font-weight: bold; background-color: #f7f5f2; font-size: 12px">1</td>
				<td style="color: #755731; font-weight: bold; background-color: #f7f5f2; font-size: 12px">Kamar Hotel</td>
				<td style="color: #755731; font-weight: bold; background-color: #f7f5f2; font-size: 12px">{{ $data['order']['room']['price'] }}</td>
				<td style="color: #755731; font-weight: bold; background-color: #f7f5f2; font-size: 12px">{{ $data['order']['check_in_date'] }}</td>
				<td style="color: #755731; font-weight: bold; background-color: #f7f5f2; font-size: 12px">{{ $data['order']['check_out_date'] }}</td>
				<td style="color: #755731; font-weight: bold; background-color: #f7f5f2; font-size: 12px">{{ $data['order']['total_guest'] }}</td>
				<td style="color: #755731; font-weight: bold; background-color: #f7f5f2; font-size: 12px">{{ $data['amount'] }}</td>
			</tr>
		</table>
	</div>

	@php
		$tax_percent = \App\Models\Setting::where('type', 'tax')->where('is_active', 1)->first();
	@endphp

	<div style="margin-top: 30px">
		<div style="position: relative">
			<div style="position: absolute; left: 550px; padding: 15px">
				<div style="color: #9E733E; font-weight: bold; font-size: 12px; padding-bottom: 10px">Diskon : {{ is_null($data['discount_amount']) ? 0 : $data['discount_amount'] }}</div>

				@if($data['tax'])

					<div style="color: #9E733E; font-weight: bold; font-size: 12px; padding-bottom: 10px">PPN : {{ $data['tax'] }} ({{ $tax_percent->value  }}%)</div>

				@else
					<div style="color: #9E733E; font-weight: bold; font-size: 12px; padding-bottom: 10px">PPN : -</div>
				@endif

				@if($data['voucher'])

					<div style="color: #9E733E; font-weight: bold; font-size: 12px; padding-bottom: 10px">Voucher : -{{ $data['voucher']['discount_amount'] }} </div>

				@endif


				
				<div style="background-color: #9E733E; color: #fff; font-weight: bold; font-size: 12px; padding: 10px 10px; text-align: center">Total : {{ $data['amount'] }}</div>
			</div>
		</div>
	</div>

	<div style="margin-top: 220px">
		<table style="width: 100%; text-align: left">
			<tr>
				<td><h2>CapsuleInn</h2></td>
				<td><h2>Bantuan</h2></td>
			</tr>

			<tr>
				<td style="font-weight: bold; color: #9E733E">Jln. P. Antasari No. 82E, Kedamaian, Kec. <br> Sukabumi Kota Bandar Lampung <br> Lampung 35122</td>
				<td style="font-weight: bold; color: #9E733E">
					<img src="{{ public_path('assets/images/letter.png') }}" alt="wa" width="15"> developercapsuleinn@gmail.com <br>
					<img src="{{ public_path('assets/images/wa.png') }}" alt="wa" width="15"> +62 853-7772-5030 
				</td>
			</tr>

			<tr>
				<td></td>
				<td></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
</body>
</html>