<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://capsuleinn.id/assets/css/vertical-layout-light/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">
	<title>Hotel</title>
</head>
<body>

    @php
        use App\Models\Tombol;
    @endphp

	<div class="page-wrapper">

		<nav class="navbar navbar-expand-lg fixed-top">
				<div class="container nav-flay">
					<a class="navbar-brand" href="{{ route('front') }}">
						<img src="{{ asset('/assets/img/logo.png') }}">
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbar">
						<div class="navbar-nav">
							<a class="nav-link" href="{{ route('front') }}">Beranda</a>
							@php
                                    $tombols = Tombol::all();
                                    foreach ($tombols as $tombolku) {
                                        $status =  $tombolku["status"];
                                    }
                            @endphp
                            @if ($status == 'on')
                                <a class="nav-link" href="{{ route('jadi.mitra') }}">Jadi Mitra</a>
                            @endif
                            @if ($status == 'off')

                            @endif
							<a class="nav-link active" href="{{ route('hotel') }}">Hotel</a>
							<a class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a>
							<a class="nav-link" href="{{ route('bantuan') }}">Bantuan</a>
                            <a class="nav-link only" href="{{route('login')}}">Masuk</a>
						</div>
					</div>
				</div>
		</nav>



		<section id="hotel" class="hotel">
			<div class="container">
				<div class="row mb-5">
					<div class="col-lg-8">
						<div class="hotel-top">
							<img class="img-fluid" src="{{ asset('storage/rooms/' .  $images->image) }}">
							<div class="caps">
								<h2>{{ $images->name }}</h2>
								<div class="starts">
                                    @for ($i = 0; $i < $images->rating; $i++)
                                        <img class="img-rating" src="{{ asset('assets/img/bintang.png') }}">
                                    @endfor
									<span>{{ $images->rating }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card">
							<form action="javascript:void(0)" method="POST">
								<h2>Cek Ketersedian Kamar</h2>
								{{-- <input type="date" name="kapan" id="kapan" placeholder="Cari Kamar" required> --}}
                                <input required type="date" name="kapan" id="kapan" title="Choose your desired date" min="<?php echo date('Y-m-d'); ?>"/>
								<button class="btn" onclick="cariAvailable()" type="button">Cari Kamar</button>
							</form>
						</div>
					</div>
				</div>

			</div>
		</section>

		<section id="list-hotel" class="list-hotel">
			<div class="container">
				<div class="row">
					<div class="col-lg-3">
						<h3>Kategori</h3>
						<ul>

                            @foreach ($types as $item)

                                <li><button type="button" onclick="cariHotelKategori('{{ $item->name }}')" class="btn">{{ $item->name }}</button></li>

                            @endforeach
						</ul>
					</div>
					<div class="col-lg-9 hotels" id="card">



                        @foreach ($hotels as $item)
						<div class="card" id="card">
                            <div class="card-img">
                                <img class="img-fluid" src="{{ asset('storage/rooms/' .  $item->image) }}">
                                    <div class="btn-action mt-2 ml-5">
                                        @foreach ($playstores as $items)
                                            <a href="{{ $items->url }}" type="button" class="btn btn-sm mx-2"><img width="10" src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
                                        @endforeach
                                        @foreach ($appstores as $items)
                                            <a href="{{ $items->url }}" type="button" class="btn btn-sm mx-2"><img width="10" src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
                                        @endforeach
                                    </div>
							</div>
							<div class="card-body">
								<div class="starts">
									<span class="badge badge-secondary">{{ $item->name }}</span>
									@for ($i = 0; $i < $item->rating; $i++)
                                        <img class="img-rating" src="{{ asset('assets/img/bintang.png') }}">
                                    @endfor
									{{-- <span> {{ $item->rating }}</span> --}}
								</div>
                                {{-- <img width="10" class="img-rating" src="{{ asset('assets/img/bintang.png') }}"> --}}
								<h3>{{ $item->nama_hotel }}</h3>
							</div>
						</div>

                        @endforeach
					</div>
				</div>
			</div>
		</section>



		<footer id="footer" class="footer">
            <div class="container">
                <div class="row">
                    @foreach ($alamats as $item)
					<div class="col-lg-6">
						<img class="img-fluid" src="{{ asset('images/compro/alamat/' . $item->gambar) }}">
                        {{-- disarankan warna putih --}}
						<p>{{ $item->keterangan }}</p>
					</div>
                    @endforeach
					<div class="col-lg-2">
						<h6 class="footer-title">Halaman</h6>
						<ul>
							<li><a style="color: white" class="nav-link active" href="{{ route('front') }}">Beranda</a></li>
							@php

                                    $tombols = Tombol::all();
                                    foreach ($tombols as $tombol) {
                                        $status =  $tombol["status"];
                                    }
                            @endphp
                            @if ($status == 'on')
                                <li><a style="color: white" class="nav-link" href="{{ route('jadi.mitra') }}">Jadi Mitra</a></li>
                            @endif
                            @if ($status == 'off')

                            @endif
							<li><a style="color: white" class="nav-link" href="{{ route('hotel') }}">Hotel</a></li>
							<li><a style="color: white" class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a></li>
							<li><a style="color: white" class="nav-link" href="{{ route('bantuan') }}">Bantuan</a></li>
						</ul>
					</div>
					<div class="col-lg-4">
						<h6 class="footer-title">Kontak</h6>
						<ul>
                            @foreach ($kontaks as $item)
                                <li>{{ $item->heading_kontak }}</li>
                            @endforeach
						</ul>

                        <h6 class="footer-title mt-5">Sosial Media</h6>
						<div>
                            @foreach ($sosmeds as $item)
                                <a class="sosial" href="{{ $item->link_sosmed }}"><i class="bi bi-{{ $item->nama_sosmed }}"></i></a>
                            @endforeach
						</div>
					</div>
				</div>
			</div>
		</footer>

	</div>

	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
	<script src="{{ asset('compro/assets/js/main.js') }}"></script>

    <script>

        function cariHotelKategori(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {"cari": e},
                url: "{{ route('cariHotelKategori') }}",
                success : function(res){
                    if(res.data == 'ada') {
                        let hotels = res.hotels
                        var jml_start = "";
                        for(let i = 0; i < hotels.length; i++){
                            jml_start += hotels[i].rating
                        }


                        console.log(jml_start)
                        let html_umar = ""
                        for (let index = 0; index < 4; index++) {
                            html_umar += `<img class="start" src="./assets/img/bintang.png">`

                        }
                        var html = "";
                        let start = ""
                        for(let i = 0; i < hotels.length; i++){
                            for(let j = 0; j < hotels[i].rating; j++) {
                               start += `<img class="start" src="./assets/img/bintang.png">`
                            }
                            html += `<div class="card">
							<div class="card-img">
								<img class="card-img-top" src="storage/rooms/`+ hotels[i].image +`">

                                <div class="btn-action mt-2 ml-5">
                                        @foreach ($playstores as $items)
                                            <a href="{{ $items->url }}" type="button" class="btn btn-sm mx-2"><img width="10" src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
                                        @endforeach
                                        @foreach ($appstores as $items)
                                            <a href="{{ $items->url }}" type="button" class="btn btn-sm mx-2"><img width="10" src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
                                        @endforeach
                                </div>
							</div>
							<div class="card-body">
								<div class="starts">
                                    <span class="badge badge-secondary">`+ hotels[i].name +`</span>
                                    `+start+`
									<span>`+ hotels[0].rating +`</span>
								</div>
								<h3>`+ hotels[0].nama_hotel +`</h3>
							</div>
						</div>`
                        }
                        $('#card').html(html)
                    }
                }
            });

        }

        function cariAvailable() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            let kapan = $('#kapan').val();
            var html = "";

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {"kapan": kapan},
                url: "{{ route('cariAvailable') }}",
                success : function(res){
                    console.log(res)
                    let room_availables = res.room_availables
                    let start = ""
                    for(let i = 0; i < room_availables.length; i++){
                        for(let j = 0; j < room_availables[i].rating; j++) {
                            start += `<img class="start" src="./assets/img/bintang.png">`
                        }
                        html += `<div class="card">
							<div class="card-img">
								<img class="card-img-top" src="storage/rooms/`+ room_availables[i].image +`">
							</div>
							<div class="card-body">
								<div class="starts">
									<span class="badge badge-secondary">`+ room_availables[i].name +`</span>
                                    `+ start +`
									<span>`+ room_availables[0].rating +`</span>
								</div>
								<h3>`+ room_availables[0].nama_hotel +`</h3>
							</div>
						</div>`
                    }
                    $('#card').html(html)

                }
            });
        }


    </script>
</body>
</html>
