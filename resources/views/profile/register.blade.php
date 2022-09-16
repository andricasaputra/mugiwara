@include('layouts.profile.header')

	<div class="page-wrapper">

		<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
			<div class="container nav-flay">
				<a class="navbar-brand" href="#">
					<img src="./assets/img/logo.png">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbar">
					<div class="navbar-nav">
						<a class="nav-link" href="./index.html">Beranda</a>
						<a class="nav-link active" href="./mitra.html">Jadi Mitra</a>
						<a class="nav-link" href="./hotel.html">Hotel</a>
						<a class="nav-link" href="./team.html">Tentang Kami</a>
						<a class="nav-link" href="./bantuan.html">Bantuan</a>
						<a class="nav-link only" href="https://capsuleinn.id/admin/login">Masuk</a>
					</div>
				</div>
			</div>
		</nav>

		<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasExampleLabel">
					<a class="navbar-brand" href="#">
					<img src="./assets/img/logo.png">
				</a>
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="navbar-nav">
					<a class="nav-link" href="./index.html">Beranda</a>
					<a class="nav-link active" href="./mitra.html">Jadi Mitra</a>
					<a class="nav-link" href="./hotel.html">Hotel</a>
					<a class="nav-link" href="./team.html">Tentang Kami</a>
					<a class="nav-link" href="./bantuan.html">Bantuan</a>
					<a class="nav-link only" href="#">Masuk</a>
				</div>
			</div>
		</div>

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

		@include('layouts.profile.bottom')

	</div>

@include('layouts.profile.footer')