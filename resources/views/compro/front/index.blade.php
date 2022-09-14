<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://capsuleinn.id/assets/css/vertical-layout-light/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">
	<title>Home</title>
</head>
<body>

	<div class="page-wrapper">

		<nav class="navbar navbar-expand-lg fixed-top">
				<div class="container nav-flay">
					<a class="navbar-brand" href="#">
                        <img src="{{ asset('images/compro/sosmed/logo.png')}}">
					</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse justify-content-end" id="navbar">
						<div class="navbar-nav">
							<a class="nav-link active" href="{{ route('front') }}">Beranda</a>
							<a class="nav-link" href="{{ route('jadi.mitra') }}">Jadi Mitra</a>
							<a class="nav-link" href="{{ route('hotel') }}">Hotel</a>
							<a class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a>
							<a class="nav-link" href="{{ route('bantuan') }}">Bantuan</a>
							<a class="nav-link only" href="/">Masuk</a>
						</div>
					</div>
				</div>
		</nav>



		<section id="avatar" class="avatar">
			<div class="container">
				<div class="row justify-content-between">
                    @foreach ($awals as $item)

					<div class="col-lg-6">
                        <h1>{{ $item->heading }}</h1>
						<p>{{ $item->keterangan }}</p>
						<div class="btn-action">
                            <button type="button" class="btn btn-sm mx-2"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></button>
							<button type="button" class="btn btn-sm mx-2"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></button>
						</div>
					</div>

                    @endforeach
					<div class="col-lg-5">
						<div class="swiper mySwiper">
							<div class="swiper-wrapper">
                                @foreach ($sliders as $item)
                                    <div class="swiper-slide">
                                        <img class="img-fluid" src="{{ asset('compro/assets/img/avatar.png') }}" />
                                    </div>
                                    <div class="swiper-slide">
                                        <img class="img-fluid" src="{{ asset('images/compro/slider/'. $item->gambar)  }}" />
                                    </div>
                                @endforeach
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section id="calculed" class="calculed">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<h1 class="display-4">{{ $data_jumlah_mitras }}+</h1>
						<p>Telah banyak mitra kami yang terpercaya den berada di beberapa wilayah Indonesia, seperti bandar lampung, dan juga medan. data dari accomodation</p>
					</div>
					<div class="col-lg-4">
						<h1 class="display-4">{{ $data_jumlah_users }}+</h1>
						<p>Banyak pengguna telah termudahkan dengan adanya aplikasi CapsuleInn. tidak pelu takut kehabisan tempat saat bepergian. data dari users</p>
					</div>
					<div class="col-lg-4">
						<h1 class="display-4">{{ $data_jumlah_customers }}+</h1>
						<p>Team support yang selalu up time 24 jam dengan lebih dari 1000 layanan perhari, dapat membantu menyelesaikan masalah pengguna. dari data users => customer</p>
					</div>
				</div>
			</div>
		</section>

        @foreach ($aboutPertamas as $item)


		<section id="quotes" class="quotes">
            <div class="container">
                <div class="row">
					<div class="col-lg-6">
						<h2>{{ $item->heading }}</h2>
						<p>{{ $item->keterangan }}</p>
					</div>
					<div class="col-lg-6">
						<img src="{{ asset('images/compro/about_pertama/'. $item->gambar)  }}">
					</div>
				</div>
			</div>
		</section>

        @endforeach

        @foreach ($aboutKeduas as $item)

            <section id="quotes" class="quotes tow">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src="{{ asset('images/compro/about_kedua/'. $item->gambar)  }}">
                        </div>
                        <div class="col-lg-6">
                            <h2>{{ $item->heading }}</h2>
                            <p>{{ $item->keterangan }}</p>
                        </div>
                    </div>
                </div>
            </section>

        @endforeach

		<section id="fiture" class="fiture">
			<div class="container">

                @foreach ($keteranganFiturs as $item)

				<div class="row">
                    <div class="col-lg-6">
                        <h2>{{ $item->heading }}</h2>
						<p>{{ $item->keterangan }} </p>
					</div>
				</div>

                @endforeach


				<div class="row mt-5">
                    @foreach ($sliderFiturs as $item)
                    <div class="col-lg-4">
						<div class="card-fitures">
                            <div class="icon-tag">
								<img class="img-fluid" width="100" src="{{ asset('images/compro/slider_fitur/' . $item->gambar) }}">
								<h3>{{ $item->heading }}</h3>
							</div>
							<p>{{ $item->keterangan }} </p>
						</div>
					</div>
                    @endforeach
				</div>

			</div>

		</section>

		<section id="ratings" class="ratings">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6">
						<h2 class="text-center">Apa yang pengguna lain katakan tentang kami</h2>
					</div>
				</div>

				<div class="row">
					<div class="swiper slide-ratings">
						<div class="swiper-wrapper">

                            @foreach ($reviews as $item)

							<div class="swiper-slide">
									<div class="card">
										<div class="card-body">
											<p> {{ $item->comment }}</p>
											<img class="img-fluid" src="{{ asset('storage/avatars/' .  $item->avatar) }}">
											<h5>{{ $item->name }}</h5>
											<div class="ranting">
												@for ($i = 0; $i < $item->rating; $i++)
                                                    <img class="img-rating" src="{{ asset('assets/img/bintang.png') }}">
                                                @endfor
											</div>
											<p>{{ $item->type }}</p>
										</div>
									</div>
							</div>


                            @endforeach

						</div>
						<div class="swiper-pagination"></div>
					</div>

				</div>
			</div>
		</section>

        <section id="news" class="news">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6">
						<h2>Dengan membaca anda dapat menambah informasi</h2>
					</div>
				</div>
				<div class="row">

                    @foreach ($posts as $item)

					<div class="col-lg-4">
                        <a href="read_berita/{{$item->id}}">
							<div class="card">
                                <div class="card-img-top">
                                    <img class="img-fluid" src="{{ asset('storage/posts/' .  $item->image) }}">
								</div>
								<div class="card-body">
									<h5>{{ $item->title }}</h5>
									<p>{{ $item->body }}</p>
								</div>
							</div>
						</a>
					</div>

                    @endforeach

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
