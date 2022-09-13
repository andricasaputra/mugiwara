<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://capsuleinn.id/assets/css/vertical-layout-light/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">
	<title>Hotel</title>
</head>
<body>

	<div class="page-wrapper">

		<nav class="navbar navbar-expand-lg fixed-top">
				<div class="container nav-flay">
					<a class="navbar-brand" href="#">
						<img src="./assets/img/logo.png">
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbar">
						<div class="navbar-nav">
							<a class="nav-link" href="{{ route('front') }}">Beranda</a>
							<a class="nav-link" href="{{ route('jadi.mitra') }}">Jadi Mitra</a>
							<a class="nav-link active" href="{{ route('hotel') }}">Hotel</a>
							<a class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a>
							<a class="nav-link" href="{{ route('bantuan') }}">Bantuan</a>
							<a class="nav-link only" href="#">Masuk</a>
						</div>
					</div>
				</div>
		</nav>

		<section id="hotel" class="hotel">
			<div class="container">
				<div class="row mb-5">
					<div class="col-lg-8">
						<div class="hotel-top">
							<img class="img-fluid" src="./assets/img/hotel1.png">
							<div class="caps">
								<h2>Rina Hotel Lampung</h2>
								<div class="starts">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<span>4.9</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card">
							<form action="" method="POST">
								<h2>Cek Ketersedian Kamar</h2>
								<input type="text" name="kapan" placeholder="Cari Kamar">
								<button class="btn" type="button">Cari Kamar</button>
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
							<li><button type="button" class="btn">Hotel terpopoler</button></li>
							<li><button type="button" class="btn">Hotel terbaru</button></li>
							<li><button type="button" class="btn">Hotel bintang lima</button></li>
							<li><button type="button" class="btn">VIP hotel</button></li>
							<li><button type="button" class="btn">Medium hotel</button></li>
						</ul>
					</div>
					<div class="col-lg-9 hotels">
						<div class="card">
							<div class="card-img">
								<img class="card-img-top" src="./assets/img/hotel2.png">
							</div>
							<div class="card-body">
								<div class="starts">
									<span class="badge badge-secondary">VIP</span>
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<span>4.5</span>
								</div>
								<h3>Hotel Santa Maria</h3>
							</div>
						</div>

						<div class="card">
							<div class="card-img">
								<img class="card-img-top" src="./assets/img/hotel3.png">
							</div>
							<div class="card-body">
								<div class="starts">
									<span class="badge badge-secondary">Medium</span>
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<span>4.6</span>
								</div>
								<h3>Hotel Emersia</h3>
							</div>
						</div>

						<div class="card">
							<div class="card-img">
								<img class="card-img-top" src="./assets/img/hotel4.png">
							</div>
							<div class="card-body">
								<div class="starts">
									<span class="badge badge-secondary">VIP</span>
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<span>4.3</span>
								</div>
								<h3>Hotel Sheraton</h3>
							</div>
						</div>

						<div class="card">
							<div class="card-img">
								<img class="card-img-top" src="./assets/img/hotel5.png">
							</div>
							<div class="card-body">
								<div class="starts">
									<span class="badge badge-secondary">VIP</span>
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<img class="start" src="./assets/img/bintang.png">
									<span>4.8</span>
								</div>
								<h3>Hotel Novotel Lampung</h3>
							</div>
						</div>
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
