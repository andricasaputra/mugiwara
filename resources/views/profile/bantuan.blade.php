@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		<section id="bantuan" class="bantuan">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-10">
						<div class="content"></div>
						<h1 class="display-4">Selesaikan semua pertanyaan dalam waktu singkat</h1>
						<form action="" method="POST">
							<input class="form-control" type="text" name="help" placeholder="Cari bantuan">
							<i class="bi bi-search"></i>
						</form>
					</div>
				</div>
			</div>
		</section>

		<section id="bantuan-list" class="bantuan-list">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 bantuan-list-items">
						<h2>Sering ditanyakan</h2>
						<ul>
							<li><a href="./tips.html">Bagaimana cara memesan kamar melalui capsule inn?</a></li>
							<li><a href="./tips.html">Bagaimana cara menukarkan voucher?</a></li>
							<li><a href="./tips.html">Apa saja fasilitas yang didapat saat menginap?</a></li>
							<li><a href="./tips.html">Bagaimana cara melakukan pembatalan untuk menginap?</a></li>
							<li><a href="./tips.html">Apa saja ketentuan untuk menukarkan voucher?</a></li>
							<li><a href="./tips.html">Bagaimana cara mendapatkan potongan harga saat booking hotel?</a></li>
							<li><a href="./tips.html">Berapa orang yang dapat menginap disatu kamar?</a></li>
						</ul>
					</div>
					<div class="col-lg-6 bantuan-list-items">
						<h2>Pertanyaan lain</h2>
						<ul>
							<li><a href="./tips.html">Adakah maksimal waktu untuk menginap?</a></li>
							<li><a href="./tips.html">Bagaimana cara menjadi mitra Capsule Inn?</a></li>
							<li><a href="./tips.html">Apakah bisa request makanan saat menginap?</a></li>
							<li><a href="./tips.html">Bagaimana cara menukarkan merchandise?</a></li>
							<li><a href="./tips.html">Apakah harga yang tertera sudah termasuk sarapan?</a></li>
							<li><a href="./tips.html">Adakah denda jika saya checkout terlambat?</a></li>
							<li><a href="./tips.html">Apakah hotel menawarkan wifi gratis?</a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section id="bantuan-form" class="bantuan-form">
			<div class="container">
				<div class="form">
					<h2>Hubungi Kami</h2>
					<div class="row">
						<div class="col-lg-6">
							<input class="input" type="text" name="name" placeholder="Nama Lengkap">
						</div>
						<div class="col-lg-6">
							<input class="input" type="email" name="email" placeholder="Email">
						</div>
						<div class="col-12">
							<input class="input" type="text" name="title" placeholder="Judul Bantuan">
						</div>
						<div class="col-lg-9">
							<textarea class="text" name="bantuan" placeholder="Jelaskan Pertanyaan Anda"></textarea>
						</div>
						<div class="col-lg-3">
							<div class="file">
								<div class="infos">
									<i class="bi bi-image-fill"></i>
									<h5>Unggah Gambar</h5>
									<p>Maksimal file 5MB .jpg atau .png</p>
								</div>
								<img src="">
								<input type="file" name="file">
							</div>
						</div>
					</div>
					<div class="row justify-content-end">
						<button class="btn" type="button">Kirim</button>
					</div>
				</div>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

@include('layouts.profile.header')