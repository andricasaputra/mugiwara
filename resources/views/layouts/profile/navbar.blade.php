<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
			<div class="container nav-flay">
				<a class="navbar-brand" href="{{ route('profile.home') }}">
					<img src="./assets/img/logo.png">
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbar">
					<div class="navbar-nav">
						<a class="nav-link {{Route::is('profile.home') ? 'active' : ''}}" href="{{ route('profile.home') }}">Beranda</a>
						<a class="nav-link {{Route::is('profile.mitra') ? 'active' : ''}}" href="{{ route('profile.mitra') }}">Jadi Mitra</a>
						<a class="nav-link {{Route::is('profile.hotel') ? 'active' : ''}}" href="{{ route('profile.hotel') }}">Hotel</a>
						<a class="nav-link {{Route::is('profile.tentang') ? 'active' : ''}}" href="{{ route('profile.tentang') }}">Tentang Kami</a>
						<a class="nav-link {{Route::is('profile.bantuan') ? 'active' : ''}}" href="{{ route('profile.bantuan') }}">Bantuan</a>
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
					<a class="nav-link active" href="{{ route('profile.home') }}}">Beranda</a>
					<a class="nav-link" href="{{ route('profile.mitra') }}">Jadi Mitra</a>
					<a class="nav-link" href="{{ route('profile.hotel') }}">Hotel</a>
					<a class="nav-link" href="{{ route('profile.tentang') }}">Tentang Kami</a>
					<a class="nav-link" href="{{ route('profile.bantuan') }}">Bantuan</a>
					<a class="nav-link only" href="{{ route('login') }}">Masuk</a>
				</div>
			</div>
		</div>