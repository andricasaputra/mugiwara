<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('compro//assets/css/responsiv.css') }}">
	<title>@yield('title')</title>
</head>
<body>
    @php

    @endphp
	<div class="page-wrapper">

		<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
			<div class="container nav-flay">
				<a class="navbar-brand" href="{{ route('front') }}">
					<img src="{{ asset('compro/assets/img/logo.png') }}">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbar">
					<div class="container nav-flay">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbar">
                            <div class="navbar-nav">
                                <a class="nav-link {{ (request()->segment(1) == '') ? 'active' : '' }}" href="{{ route('front') }}">Beranda</a>
                                @php
                                		$status = 'off';
                                        foreach ($tombols as $tombolku) {
                                            $status =  $tombolku["status"];
                                        }
                                @endphp
                                @if ($status == 'on')
                                    <a class="nav-link {{ (request()->segment(1) == 'jadi_mitra') ? 'active' : '' }}" href="{{ route('jadi.mitra') }}">Mitra</a>
                                @endif
                                @if ($status == 'off')

                                @endif

                                <a class="nav-link {{ (request()->segment(1) == 'hotel') ? 'active' : '' }}" href="{{ route('hotel') }}">Hotel</a>
                                <a class="nav-link {{ (request()->segment(1) == 'tentang_kami') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang Kami</a>
                                <a class="nav-link {{ (request()->segment(1) == 'bantuan') ? 'active' : '' }}" href="{{ route('bantuan') }}">Bantuan</a>
                                <a class="nav-link only" href="{{route('login')}}">Masuk</a>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</nav>

		<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasExampleLabel">
					<a class="navbar-brand" href="#">
					<img src="{{ asset('compro/assets/img/logo.png') }}">
				</a>
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="navbar-nav">
                    <a class="nav-link {{ (request()->segment(1) == '') ? 'active' : '' }}" href="{{ route('front') }}">Beranda</a>
                    {{-- <a class="nav-link {{ (request()->segment(1) == '') ? 'active' : '' }}" href="{{ route('front') }}">Beranda</a> --}}
                    @php
                            foreach ($tombols as $tombolku) {
                                $status =  $tombolku["status"];
                            }
                    @endphp
                    @if ($status == 'on')
                        <a class="nav-link {{ (request()->segment(1) == 'jadi_mitra') ? 'active' : '' }}" href="{{ route('jadi.mitra') }}">Mitra</a>
                    @endif
                    @if ($status == 'off')

                    @endif

                    <a class="nav-link {{ (request()->segment(1) == 'hotel') ? 'active' : '' }}" href="{{ route('hotel') }}">Hotel</a>
                    <a class="nav-link {{ (request()->segment(1) == 'tentang_kami') ? 'active' : '' }}" href="{{ route('tentang') }}">Tentang Kami</a>
                    <a class="nav-link {{ (request()->segment(1) == 'bantuan') ? 'active' : '' }}" href="{{ route('bantuan') }}">Bantuan</a>
                    <a class="nav-link only" href="{{route('login')}}">Masuk</a>
                </div>
			</div>
		</div>

        @yield('content')

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

                                    // $tombols = Tombol::all();
                                    foreach ($tombols as $tombol) {
                                        $status =  $tombol["status"];
                                    }
                            @endphp
                            @if ($status == 'on')
                                <li><a style="color: white" class="nav-link" href="{{ route('jadi.mitra') }}">Mitra</a></li>
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

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
	<script src="{{ asset('compro/assets/js/main.js') }}"></script>

	@stack('scripts')

</body>
</html>
