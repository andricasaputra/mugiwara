@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

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
							
							<div class="swiper-slide">
								<img class="img-fluid" src="./assets/img/mitra1.png">
							</div>

							<div class="swiper-slide">
								<img class="img-fluid" src="./assets/img/mitra2.png">
							</div>	

							<div class="swiper-slide">
								<img class="img-fluid" src="./assets/img/mitra1.png">
							</div>

							<div class="swiper-slide">
								<img class="img-fluid" src="./assets/img/mitra2.png">
							</div>

						</div>
					</div>
				</div>

			</div>
		</section>

		<section id="prasyarat" class="prasyarat">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 prasyarat-items">
						<h2>Proses Pendaftaran</h2>
						<div class="list"><span>1</span><p>Isi Form pendaftaran sesuai dengan identitas anda</p></div>
						<div class="list"><span>2</span><p>Unggah berkas pengajuan</p></div>
						<div class="list"><span>3</span><p>Survei tempat yang akan menjadi mitra CapsuleInn</p></div>
						<div class="list"><span>4</span><p>Persetujuan menjadi mitra</p></div>
					</div>

					<div class="col-lg-6 prasyarat-items">
						<h2>Syarat dan Dokumen</h2>
						<div class="list"><span>1</span><p>Siapkan dokumen asli  berupa KTP dan KK</p></div>
						<div class="list"><span>2</span><p>Unduh dan setujuai dokumen persyaratan, <a href="">unduh dakumen</a></p></div>
						<div class="list"><span>3</span><p>Unggah kembali keseluruhan data pada form yang telah di sediakan</p></div>
					</div>
				</div>
			</div>
		</section>

		<section id="join" class="join">
			<div class="container">
				<div class="row justify-content-center align-items-center">
					<div class="col-lg-6 text-center">
						<h1 class="display-4">Awali perubahan dari sekarang</h1>
						<a class="btn" href="./register.html">Gabung Sekarang</a>
					</div>
				</div>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

	@include('layouts.profile.footer')