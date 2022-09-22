<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/responsiv.css') }}">
	<title>Hotel</title>
</head>
<body>

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
						<a class="nav-link active" href="./hotel.html">Hotel</a>
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
					<a class="nav-link active" href="./index.html">Beranda</a>
					<a class="nav-link" href="./mitra.html">Jadi Mitra</a>
					<a class="nav-link" href="./hotel.html">Hotel</a>
					<a class="nav-link" href="./team.html">Tentang Kami</a>
					<a class="nav-link" href="./bantuan.html">Bantuan</a>
					<a class="nav-link only" href="#">Masuk</a>
				</div>
			</div>
		</div>

    	<section id="hotel" class="hotel">

		    <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-8 hotel-items">
                        <div class="hotel-top">

                        	@if(!is_null($trending?->image))
                            	<img class="img-fluid" src="{{ asset('storage/accomodations/' . $trending?->image?->image) }}" style="width: 100%">
                            @else
                            	<img class="img-fluid" src="{{ asset('storage/rooms/' . $trending?->room?->first()?->images->first()?->image) }}" style="width: 100%">
                            @endif

                            <div class="caps">
                                <h2>{{ $trending?->name }}</h2>                         
                                <div class="starts">
                  	
                                	@foreach($trending?->reviews as $review)
                                		<img class="start" src="{{ asset('compro/assets/img/bintang.png') }}">
                                	@endforeach

                                    <span>{{ $trending?->reviews?->avg('rating') }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 hotel-items">
                        <div class="card">
                            <form action="" method="POST">
                                <h2>Cek Ketersedian Kamar</h2>
                                <input type="date" name="tanggal" placeholder="Cari Kamar">
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

                    	@foreach($accomodations as $accomodation)

                    		 <div class="card">
	                            <div class="card-img">

	                            	@if(file_exists(asset('/storage/accomodations/' . $accomodation->image?->image)))
		                            	<img class="card-img-top" src="{{ asset('/storage/accomodations/' . $accomodation->image?->image) }}" style="width: 100%; height: 100%">
		                            @else
		                            	<img class="card-img-top" src="{{ asset('/storage/rooms/' . $accomodation->room?->first()?->images?->first()?->image) }}" style="width: 100%; height: 100%">
		                            @endif

	                                <div class="link-action">
	                                    <a href="#" class="btn btn-sm btn-redirect"><img src="{{ asset('compro/assets/img/appstore.png') }}"><span class="mx-3">Appstore</span></a>
	                                    <a href="#" class="btn btn-sm btn-redirect"><img src="{{ asset('compro/assets/img/playstore.png') }}"><span class="mx-3">Playstore</span></a>
	                                </div>
	                            </div>
	                            <div class="card-body">
	                                <div class="starts">

	                                    <span class="badge badge-secondary">{{ $accomodation?->room?->first()?->type?->name }}</span>

	                                   @foreach($accomodation?->reviews as $review)
	                                		<img class="start" src="{{ asset('compro/assets/img/bintang.png') }}">
	                                	@endforeach
	                                    
	                                    <span>{{ $accomodation?->reviews?->avg('rating') ?? '' }}</span>
	                                </div>
	                                <h3>{{ $accomodation->name }}</h3>
	                            </div>
	                        </div>

	                

                    	@endforeach
                  
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
				<div class="row copyright">
					<span>Copyright © CapsuleInn. All Rights Reserved</span>
					<span>|</span>
					<span>Creator by <a href="https://khusniridh0.github.io/creator/" target="_blank">Khusni Ridho</a></span>
				</div>
			</div>
		</footer>

	</div>

	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

	<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
	<script src="{{ asset('compro/assets/js/main.js') }}"></script>
</body>
</html>