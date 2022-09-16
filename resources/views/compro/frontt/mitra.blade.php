
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://capsuleinn.id/assets/css/vertical-layout-light/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">
	<title>Mitra</title>
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
							<li><a style="color: white" class="nav-link" href="{{ route('front') }}">Beranda</a></li>
							@php
                                    $tombols = Tombol::all();
                                    foreach ($tombols as $tombolku) {
                                        $status =  $tombolku["status"];
                                    }
                            @endphp
                            @if ($status == 'on')
                                <a class="nav-link active" href="{{ route('jadi.mitra') }}">Jadi Mitra</a>
                            @endif
                            @if ($status == 'off')

                            @endif
							<li><a style="color: white" class="nav-link" href="{{ route('hotel') }}">Hotel</a></li>
							<li><a style="color: white" class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a></li>
							<li><a style="color: white" class="nav-link" href="{{ route('bantuan') }}">Bantuan</a></li>
						</div>
					</div>
				</div>
		</nav>

		<section id="mitra" class="mitra">
			<div class="container">
				<div class="row mb-5">
					<div class="col-lg-6">
						<h1>Yang telah bergabung dan menjadi mitra kami</h1>
						<p>Yakinkan diri anda untuk bergabung bersama kami, bangun peluang baru di sekitar anda</p>
					</div>
				</div>

				<div class="row">
					<div class="swiper slide-mitra">
						<div class="swiper-wrapper">

                            @foreach ($images_rooms as $item)
                                <div class="swiper-slide">
                                    <img class="img-fluid" src="{{ asset('storage/rooms/' .  $item->image) }}">
                                </div>
                            @endforeach
						</div>
					</div>
				</div>

			</div>
		</section>

		<section id="prasyarat" class="prasyarat">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h2>Proses Pendaftaran</h2>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($prosesPendaftarans as $item)
                        @php
                            $no++;
                        @endphp

                            <div class="list"><span>{{$no}}</span><p>{{ $item->keterangan }}</p></div>

                        @endforeach
					</div>

					<div class="col-lg-6">
						<h2>Syarat dan Dokumen</h2>

                            @foreach ($unduhs as $item)
                            <div class="list"><span>1</span><p>Unduh dan setujuai dokumen persyaratan, <a href="{{ route('download', $item->id) }}">unduh dakumen</a></p></div>
                            @endforeach

                            @php
                                $no =1;
                            @endphp
                            @foreach ($syarats as $item)

                            @php
                                $no++;
                                @endphp
                            <div class="list"><span>{{$no}}</span><p>{{ $item->keterangan }}</p></div>
                        @endforeach
					</div>
				</div>
			</div>
		</section>

		<section id="join" class="join">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-6 text-center">
						<h1 class="display-4">Awali perubahan dari sekarang</h1>
						<a class="btn"

                            @foreach ($tombols as $item)
                                @php
                                    $status = $item->status
                                @endphp
                                @if ($status == "off")
                                    href="javascript:void(0)"
                                @endif
                                @if ($status == "on")
                                    href="{{ route('gabung') }}"
                                @endif
                            @endforeach

                        href="{{ route('gabung') }}">Gabung Sekarang</a>
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
</body>
</html>
