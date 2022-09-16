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
							<li><a href="{{ route('profile.home') }}">Beranda</a></li>
							<li><a href="{{ route('profile.mitra') }}">Jadi Mitra</a></li>
							<li><a href="{{ route('profile.hotel') }}">Hotel</a></li>
							<li><a href="{{ route('profile.tentang') }}">Tentang Kami</a></li>
							<li><a href="{{ route('profile.bantuan') }}">Bantuan</a></li>
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
					<span>{{ date('Y') }}</span>
				</div>
			</div>
		</footer>