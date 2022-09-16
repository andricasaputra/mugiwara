@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		<section id="avatar" class="avatar">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h1>CapsuleInn, Hotel dan penginapan</h1>
						<p>CapsuleInn adalah sebuah aplikasi atau platform yang digunakan untuk melakukan pemesanan hotel dengan mudah. CapsuleInn menawarkan kemudahan mencari hotel dan memberikan banyak fasilitas untuk mendukung kenyamanan  pelanggan.</p>
						<div class="btn-action">
							<a id="appstore"  href="#" class="btn mx-lg-2"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
							<a id="playstore" href="#" class="btn mx-lg-2"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="swiper mySwiper">
							<div class="swiper-wrapper">
								@foreach($sliders as $slider)

									<div class="swiper-slide">
										<img class="img-fluid" src="{{ asset('images/compro/slider/' . $slider->gambar ) }}" />
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
					<div class="col-lg-4 items-calculed">
						<h1 class="display-4">900+</h1>
						<p>Telah banyak mitra kami yang terpercaya den berada di beberapa wilayah Indonesia, seperti bandar lampung, dan juga medan.</p>
					</div>
					<div class="col-lg-4 items-calculed">
						<h1 class="display-4">80547+</h1>
						<p>Banyak pengguna telah termudahkan dengan adanya aplikasi CapsuleInn. tidak pelu takut kehabisan tempat saat bepergian.</p>
					</div>
					<div class="col-lg-4 items-calculed">
						<h1 class="display-4">1547+</h1>
						<p>Team support yang selalu up time 24 jam dengan lebih dari 1000 layanan perhari, dapat membantu menyelesaikan masalah pengguna.</p>
					</div>
				</div>
			</div>
		</section>

		<section id="quotes" class="quotes">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h2>Mencari penginapan terdekat dari lokasi anda</h2>
						<p>Anda tidak perlu khawatir jika sedang bepergian  jauh dari lokasi tempat tinggal anda, tidak perlu bersusah payah berkeliling mencari hotel untuk menginap. Karena, aplikasi CapsuleInn hadir untuk membantu anda mencari lokasi penginapan yang sesuai  referensi  dan terdekat dengan lokasi anda berada.</p>
					</div>
					<div class="col-lg-6">
						<img src="./assets/img/bro.png">
					</div>
				</div>
			</div>
		</section>

		<section id="quotes" class="quotes tow">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<img src="./assets/img/orb.png">
					</div>
					<div class="col-lg-6">
						<h2>Menjamin kepuasan pengguna dan mitra CapsuleInn</h2>
						<p>Berbagai macam layanan yang disediakan oleh CapsuleInn, akan membantu anda sebagai pengguna untuk menyelesaikan permasalahan  terkait dengan penginapan dan membantu anda sebagai mitra untuk mengembangkan bisnis anda dengan sangat pesat. CapsuleInn menjamin pemberian layanan terbaik demi kepuasan anda.</p>
					</div>
				</div>
			</div>
		</section>

		<section id="fiture" class="fiture">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h2>Fitur - fitur yang tersedia di aplikasi CapsuleInn</h2>
						<p>CapsuleInn memiliki banyak fitur yang dapat digunakan untuk memberikan layanan terbaik bagi pengguna CapsuleInn. Semua fitur kami sediakan untuk mendukung kepuasan anda selaku pengguna, selain itu kami merancang CapsuleInn untuk memberikan anda keuntungan selain dari layanan dengan adanya Referral. </p>
					</div>
				</div>

				<div class="row mt-5">
					<div class="col-lg-4 fiture-items">
						<div class="card-fitures">
							<div class="icon-tag">
								<img class="img-fluid" src="./assets/img/booking.png">
								<h3>Booking</h3>
							</div>
							<p>Anda dapat melakukan booking hotel dengan mudah sesuai referensi yang anda inginkan. Anda dapat melihat terlebih dahulu fasilitas yang ditawarkan oleh hotel tempat anda akan menginap, selain itu juga anda dapat melihat jumlah tamu yang dapat menginap di hotel tersebut. </p>
						</div>
					</div>

					<div class="col-lg-4 fiture-items">
						<div class="card-fitures">
							<div class="icon-tag">
								<img class="img-fluid" src="./assets/img/refun.png">
								<h3>Refund</h3>
							</div>
							<p>Jika anda memiliki kendala atau alasan tertentu untuk melakukan pembatalan menginap disuatu hotel, anda bisa melakukan hal itu dan akan mendapatkan refund atau pengembalian dana, dengan syarat sebelumnya yaitu anda harus memberikan alasan batal booking dan syarat lainnya.</p>
						</div>
					</div>

					<div class="col-lg-4 fiture-items">
						<div class="card-fitures">
							<div class="icon-tag">
								<img class="img-fluid" src="./assets/img/referal.png">
								<h3>Referal</h3>
							</div>
							<p>Dengan menggunakan kode referal anda akan mendapatkan poin dengan cara menyebarluaskan kode referal milik anda, semakin banyak orang yang memasukan kode referal milik anda maka akan semakin banyak pula poin dan keuntungan yang anda dapatkan.</p>
						</div>
					</div>
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
							
							<div class="swiper-slide">
									<div class="card">
										<div class="card-body">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sagittis suscipit neque quis lacus, dolor nisi viverra. In in et morbi ut vitae mi adipiscing. Purus diam sit blandit in. Semper etiam pharetra est dictum. Et aliquam cras ullamcorper tellus sed tellus mi. Quis aenean ac diam elementum quis amet. Facilisis sed odio massa, malesuada et imperdiet. Eu molestie integer suspendisse massa.</p>
											<img class="img-fluid" src="./assets/img/avatar.png">
											<h5>James Franci</h5>
											<div class="ranting">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
											</div>
											<p>Costumer</p>
										</div>
									</div>
							</div>

							<div class="swiper-slide">
									<div class="card">
										<div class="card-body">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sagittis suscipit neque quis lacus, dolor nisi viverra. In in et morbi ut vitae mi adipiscing. Purus diam sit blandit in. Semper etiam pharetra est dictum. Et aliquam cras ullamcorper tellus sed tellus mi. Quis aenean ac diam elementum quis amet. Facilisis sed odio massa, malesuada et imperdiet. Eu molestie integer suspendisse massa.</p>
											<img class="img-fluid" src="./assets/img/avatar.png">
											<h5>James Franci</h5>
											<div class="ranting">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
											</div>
											<p>Costumer</p>
										</div>
									</div>
							</div>

							<div class="swiper-slide">
									<div class="card">
										<div class="card-body">
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sagittis suscipit neque quis lacus, dolor nisi viverra. In in et morbi ut vitae mi adipiscing. Purus diam sit blandit in. Semper etiam pharetra est dictum. Et aliquam cras ullamcorper tellus sed tellus mi. Quis aenean ac diam elementum quis amet. Facilisis sed odio massa, malesuada et imperdiet. Eu molestie integer suspendisse massa.</p>
											<img class="img-fluid" src="./assets/img/avatar.png">
											<h5>James Franci</h5>
											<div class="ranting">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
												<img class="img-rating" src="./assets/img/bintang.png">
											</div>
											<p>Costumer</p>
										</div>
									</div>
							</div>

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
					<div class="swiper slide-news">
							<div class="swiper-wrapper">

								<div class="swiper-slide">
									<div class="news-items">
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
								</div>

								<div class="swiper-slide">
									<div class="news-items">
										<a href="./read.html">
											<div class="card">
												<div class="card-img-top">
													<img class="img-fluid" src="./assets/img/berita2.png">
												</div>
												<div class="card-body">
													<h5>Tips dapatkan potongan harga saat menginap</h5>
													<p>Dapatkan banyak potongan harga saat anda menginap dengan cara mengumpulkan poin dan menukarkannya</p>
												</div>
											</div>
										</a>
									</div>
								</div>

								<div class="swiper-slide">
									<div class="news-items">
										<a href="./read.html">
											<div class="card">
												<div class="card-img-top">
													<img class="img-fluid" src="./assets/img/berita3.png">
												</div>
												<div class="card-body">
													<h5>Destinasi wisata alam yang wajib anda kunjungi</h5>
													<p>Anda dapat mengunjungi berbagai tempat wisata diberbagai daerah, Banyak sekali destinasi yang wajib anda kunjungi</p>
												</div>
											</div>
										</a>
									</div>
								</div>
								
							</div>
						</div>

				</div>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

	@include('layouts.profile.footer')

	