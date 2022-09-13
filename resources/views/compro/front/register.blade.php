<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://capsuleinn.id/assets/css/vertical-layout-light/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">

	<title>Gabung</title>
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
							<a class="nav-link active" href="{{ route('jadi.mitra') }}">Jadi Mitra</a>
							<a class="nav-link" href="{{ route('hotel') }}">Hotel</a>
							<a class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a>
							<a class="nav-link" href="{{ route('bantuan') }}">Bantuan</a>
						<a class="nav-link only" href="#">Masuk</a>
					</div>
				</div>
			</div>
		</nav>

		<section id="form-register" class="form-register">
			<div class="container">
				<div class="form">
					<h2>Raih Sukses Bersama CapsuleInn</h2>
					<div class="row">
						<div class="col-lg-6">
							<input class="input" type="text" name="name" placeholder="Nama Lengkap">
						</div>
						<div class="col-lg-6">
							<input class="input" type="email" name="email" placeholder="Email">
						</div>
						<div class="col-lg-6">
							<input class="input" type="text" name="nope" placeholder="Nomor Telepon">
						</div>
						<div class="col-lg-6">
							<input class="input" type="text" name="nik" placeholder="NIK">
						</div>
						<div class="col-lg-9">
							<textarea class="text" name="tempat_tinggal" placeholder="Alamat Tempat Usaha"></textarea>
							<textarea class="text" name="tempat_usaha" placeholder="Alamat Tinggal Anda"></textarea>
						</div>
						<div class="col-lg-3">
							<div class="files">
								<div class="infos">
									<i class="bi bi-file-earmark-zip"></i>
									<h5>Unggah Files</h5>
									<p>Maksimal file 5MB .zip</p>
								</div>
								<input type="file" name="file">
							</div>
						</div>
					</div>
					<div class="row justify-content-end">
							<button class="btn" type="button">Kirim Berkas</button>
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
	<script src="{{ asset('compro/assets/js/main.js') }}"></script>

</body>
</html>
