<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://capsuleinn.id/assets/css/vertical-layout-light/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="./assets/css/main.css">
	<title>Home</title>
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
						<a class="nav-link active" href="./index.html">Beranda</a>
						<a class="nav-link" href="./mitra.html">Jadi Mitra</a>
						<a class="nav-link" href="./hotel.html">Hotel</a>
						<a class="nav-link" href="./team.html">Tentang Kami</a>
						<a class="nav-link" href="./bantuan.html">Bantuan</a>
						<a class="nav-link only" href="#">Masuk</a>
					</div>
				</div>
			</div>
		</nav>

        @foreach ($posts as $item)

		<section id="read" class="read">
			<div class="container">
				<div class="row">
					<div class="col-8">
						<h1>Tips dan Trik liburan dengan harga terjangkau</h1>
					</div>
				</div>
				<div class="row justify-content-between align-items-center px-3">
					<p>2{{ $item->created_at }}</p>
					<span class="badge">Informasi</span>
				</div>
				<div class="row">
					<img class="img-fluid" src="./assets/img/berita.png">
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">


                            <h2 class="mb-3">{{ $item->title }}</h2>
                            <p class="mb-5">{{ $item->body }}</p>

                        </div>
                    </div>
                </div>
            </section>

        @endforeach

		<section id="news" class="news">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h3 class="mb-3">Berita lainnya</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-4">
						<a href="./read.html">
							<div class="card">
								<div class="card-img-top">
									<img class="img-fluid" src="./assets/img/berita1.png">
								</div>
								<div class="card-body">
									<h5>Penataan kamar agar terlihat rapi dan menarik</h5>
									<p>Apa saja trik menata kamar tidur yang bisa kamu terapkan agar kamarmu selalu tampil rapi dan sempurna? Simak artikel </p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-4">
						<a href="./read.html">
							<div class="card">
								<div class="card-img-top">
									<img class="img-fluid" src="./assets/img/berita2.png">
								</div>
								<div class="card-body">
									<h5>TIps dapatkan potongan harga saat menginap</h5>
									<p>Dapatkan banyak potongan harga saat anda menginap dengan cara mengumpulkan poin dan menukarkannya</p>
								</div>
							</div>
						</a>
					</div>

					<div class="col-lg-4">
						<a href="./read.html">
							<div class="card">
								<div class="card-img-top">
									<img class="img-fluid" src="./assets/img/berita3.png">
								</div>
								<div class="card-body">
									<h5>Destinasi wisata alam yang wajib anda kunjungi</h5>
									<p>Anda dapat mengunjungi berbagai tempat wisata diberbagai daerah,. Banyak sekali destinasi yang wajib anda kunjungi</p>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</section>

		<footer id="footer" class="footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<img class="img-fluid" src="./assets/img/logo.png">
						<p>Jl. P. Antasari, Kedamaian, Kec. Kedamaian, Kota Bandar Lampung, Lampung 35122</p>
					</div>
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
							<li>+62 853-7772-5030</li>
							<li>developercapsuleinn@gmail.com</li>
						</ul>

						<h6 class="footer-title mt-5">Sosial Media</h6>
						<div>
							<a class="sosial" href="#"><i class="bi bi-facebook"></i></a>
							<a class="sosial" href="#"><i class="bi bi-instagram"></i></a>
							<a class="sosial" href="#"><i class="bi bi-twitter"></i></a>
						</div>
					</div>
				</div>
			</div>
		</footer>

	</div>

	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
	<script src="./assets/js/main.js"></script>
</body>
</html>
