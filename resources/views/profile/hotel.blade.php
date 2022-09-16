@include('layouts.profile.header')


	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		<section id="hotel" class="hotel">
			<div class="container">
				<div class="row mb-5">
					<div class="col-lg-8 hotel-items">
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
						<div class="card">
							<div class="card-img">
								<img class="card-img-top" src="./assets/img/hotel2.png">
								<div class="link-action">
									<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
									<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
								</div>
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
								<div class="link-action">
									<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
									<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
								</div>
							</div>
							<div class="card-body">
								<div class="starts">
									<span class="badge badge-secondary">VIP</span>
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
								<div class="link-action">
									<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
									<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
								</div>
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
								<div class="link-action">
									<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
									<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
								</div>
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

		@include('layouts.profile.bottom')

	</div>

@include('layouts.profile.footer')