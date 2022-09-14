<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://capsuleinn.id/assets/css/vertical-layout-light/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">
	<title>Tentang Kami</title>
</head>
<body>

	<div class="page-wrapper">

		<nav class="navbar navbar-expand-lg fixed-top">
				<div class="container nav-flay">
					<a class="navbar-brand" href="#">
						<img src="{{ asset('/assets/img/logo.png') }}">
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbar">
						<div class="navbar-nav">
							<a class="nav-link" href="{{ route('front') }}">Beranda</a>
							<a class="nav-link" href="{{ route('jadi.mitra') }}">Jadi Mitra</a>
							<a class="nav-link" href="{{ route('hotel') }}">Hotel</a>
							<a class="nav-link active" href="{{ route('tentang') }}">Tentang Kami</a>
							<a class="nav-link" href="{{ route('bantuan') }}">Bantuan</a>
							<a class="nav-link only" href="/">Masuk</a>
						</div>
					</div>
				</div>
		</nav>

		<section id="team" class="team">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h1>Tim Pendiri CapsuleInn</h1>
						<p>Mereka adalah orang orang hebat yang bisa merubah masalah menjadi solusi, dengan menghadirkan aplikasi CapsuleInn. memudahkan pencarian tempat menginap dimanapun lokasi anda di Indonesia.</p>
					</div>
					<div class="col-lg-5">
                        <img class="img-fluid" src="{{ asset('assets/img/' . $teams->gambar) }}">
					</div>
				</div>
			</div>
		</section>

		<section id="list-teams" class="list-teams">
			<div class="container">
				<div class="row">
                    @foreach ($teamHeaders as $item)

					<div class="col-lg-4">
                        <div class="card">
                            <img class="card-img-top" src="{{ asset('images/compro/team_header/'. $item->gambar) }}">
							<div class="card-body">
                                <h2>{{ $item->heading }}</h2>
								<h5>{{ $item->jabatan }}</h5>
								<div>
                                    <i class="bi bi-{{ $item->gambar_sosmed }}"></i>
									{{-- <i class="bi bi-twitter"></i> --}}
								</div>
							</div>
						</div>
					</div>

                    @endforeach

				</div>
			</div>
		</section>


		<section id="founder" class="founder">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<img class="img-fluid" src="{{ asset('images/compro/team_header/'. $teams->gambar) }}">
					</div>
					<div class="col-lg-6">
						<h2>{{ $teams->heading }}</h2>
						<h5>{{ $teams->jabatan }}</h5>
						<p>{{ $teams->keterangan }}</p>
					</div>
				</div>
			</div>
		</section>

		<section id="visi" class="visi">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h2>Visi</h2>
						<div class="accordion">
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($visis as $item)
                            @php
                                $no++;
                            @endphp

							<div class="accordion-items active">
                                <div class="accordion-heading">
                                    <h6>{{ $no }}. {{ $item->heading }}</h6>
									<i class="bi bi-caret-up"></i>
								</div>
								<div class="accordion-content">
                                    <p>{{ $item->keterangan }}</p>
								</div>
							</div>
                            @endforeach
						</div>

						<h2>Misi</h2>

						<div class="accordion">
                            @php
                                $no = 0;
                            @endphp
                            @foreach ($misis as $item)
                            @php
                                $no++;
                            @endphp

							<div class="accordion-items">
                                <div class="accordion-heading">
                                    <h6>{{ $no }}. {{ $item->heading }}</h6>
									<i class="bi bi-caret-up"></i>
								</div>
								<div class="accordion-content">
                                    <p>{{ $item->keterangan }}</p>
								</div>
							</div>

                            @endforeach


						</div>

					</div>
					<div class="col-lg-6">
						<img class="img-fluid" src="{{ asset('/assets/img/ide.png') }}">
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
							<li>Beranda</li>
							<li>Jadi Mitra</li>
							<li>Hotel</li>
							<li>Tentang Kami</li>
							<li>Bantuan</li>
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
