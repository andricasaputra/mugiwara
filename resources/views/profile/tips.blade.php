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
						<a class="nav-link" href="./mitra.html">Jadi Mitra</a>
						<a class="nav-link" href="./hotel.html">Hotel</a>
						<a class="nav-link" href="./team.html">Tentang Kami</a>
						<a class="nav-link active" href="./bantuan.html">Bantuan</a>
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
					<a class="nav-link active" href="./index.html">Beranda</a>
					<a class="nav-link" href="./mitra.html">Jadi Mitra</a>
					<a class="nav-link" href="./hotel.html">Hotel</a>
					<a class="nav-link" href="./team.html">Tentang Kami</a>
					<a class="nav-link" href="./bantuan.html">Bantuan</a>
					<a class="nav-link only" href="#">Masuk</a>
				</div>
			</div>
		</div>

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
				<div class="row reading">
					<div class="col-lg-4 bantuan-list-items reading">
						<h2>Pertannya lain</h2>
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
					<div class="col-lg-8 bantuan-list-items">
						<h1 class="mb-5">Bagaimana cara memesan kamar melalui capsule inn?</h1 class="display-4">
						<img class="img-fluid mb-4" src="./assets/img/tips.png">
						<p>Consectetur adipiscing elit. Sit eleifend congue lacus sed non tincidunt. Tellus, mauris tincidunt sapien est porttitor tellus. Pretium eget non tincidunt felis et est porta arcu. Posuere rhoncus, urna, viverra congue viverra sit nec a laoreet. Elit sem duis elit nibh netus egestas. Pulvinar suspendisse elementum praesent vitae quam euismod auctor pellentesque. Eu at eu nullam aliquam ut in scelerisque. Vel dictum blandit placerat hac in augue tellus. At etiam faucibus diam eget erat nec quisque. Magnis interdum est enim sit. Vitae lacus.</p>
						<h2 class="mt-4">Langkah langkah pemesanan kamar</h2>
						<p>Consectetur adipiscing elit. Sit eleifend congue lacus sed non tincidunt. Tellus, mauris tincidunt sapien est porttitor tellus. Pretium eget non tincidunt felis et est porta arcu. Posuere rhoncus, urna, viverra congue viverra sit nec a laoreet. Elit sem duis elit nibh netus egestas. Pulvinar suspendisse elementum praesent vitae quam euismod auctor pellentesque. Eu at eu nullam aliquam ut in scelerisque. Vel dictum blandit placerat hac in augue tellus. At etiam faucibus diam eget erat nec quisque. Magnis interdum est enim sit. Vitae lacus.</p>
						<h2 class="mt-4">Langkah pertama</h2>
						<p>Consectetur adipiscing elit. Sit eleifend congue lacus sed non tincidunt. Tellus, mauris tincidunt sapien est porttitor tellus. Pretium eget non tincidunt felis et est porta arcu. Posuere rhoncus, urna, viverra congue viverra sit nec a laoreet. Elit sem duis elit nibh netus egestas. Pulvinar suspendisse elementum praesent vitae quam euismod auctor pellentesque. Eu at eu nullam aliquam ut in scelerisque. Vel dictum blandit placerat hac in augue tellus. At etiam faucibus diam eget erat nec quisque. Magnis interdum est enim sit. Vitae lacus.</p>
						<h2 class="mt-4">Langkah ke dua</h2>
						<p>Consectetur adipiscing elit. Sit eleifend congue lacus sed non tincidunt. Tellus, mauris tincidunt sapien est porttitor tellus. Pretium eget non tincidunt felis et est porta arcu. Posuere rhoncus, urna, viverra congue viverra sit nec a laoreet. Elit sem duis elit nibh netus egestas. Pulvinar suspendisse elementum praesent vitae quam euismod auctor pellentesque. Eu at eu nullam aliquam ut in scelerisque. Vel dictum blandit placerat hac in augue tellus. At etiam faucibus diam eget erat nec quisque. Magnis interdum est enim sit. Vitae lacus.</p>
						<h2 class="mt-4">Langkah ke tiga</h2>
						<p>Consectetur adipiscing elit. Sit eleifend congue lacus sed non tincidunt. Tellus, mauris tincidunt sapien est porttitor tellus. Pretium eget non tincidunt felis et est porta arcu. Posuere rhoncus, urna, viverra congue viverra sit nec a laoreet. Elit sem duis elit nibh netus egestas. Pulvinar suspendisse elementum praesent vitae quam euismod auctor pellentesque. Eu at eu nullam aliquam ut in scelerisque. Vel dictum blandit placerat hac in augue tellus. At etiam faucibus diam eget erat nec quisque. Magnis interdum est enim sit. Vitae lacus.</p>
						<h2 class="mt-4">Langkah ke empat</h2>
						<p>Consectetur adipiscing elit. Sit eleifend congue lacus sed non tincidunt. Tellus, mauris tincidunt sapien est porttitor tellus. Pretium eget non tincidunt felis et est porta arcu. Posuere rhoncus, urna, viverra congue viverra sit nec a laoreet. Elit sem duis elit nibh netus egestas. Pulvinar suspendisse elementum praesent vitae quam euismod auctor pellentesque. Eu at eu nullam aliquam ut in scelerisque. Vel dictum blandit placerat hac in augue tellus. At etiam faucibus diam eget erat nec quisque. Magnis interdum est enim sit. Vitae lacus.</p>
					</div>
				</div>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

@include('layouts.profile.footer')