@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		<section id="form-register" class="form-register">
			<div class="container">
				@if(session()->has('error'))
                    <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @endif
				@if(session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
				<form action="{{ route('profile.register.submit') }}" enctype="multipart/form-data" method="post">
					@csrf
					<div class="form">
						<h2>Raih Sukses Bersama CapsuleInn</h2>
						<div class="row">
							<div class="col-lg-6">
								<input class="input" type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
							</div>
							<div class="col-lg-6">
								<input class="input" type="email" name="email" placeholder="Email" required>
							</div>
							<div class="col-lg-6">
								<input class="input" type="number" name="hp" placeholder="Nomor Telepon" required>
							</div>
							<div class="col-lg-6">
								<input class="input" type="number" name="nik" placeholder="NIK" required>
							</div>
							<div class="col-lg-9">
								<textarea class="text" name="alamat_usaha" placeholder="Alamat Tempat Usaha" required></textarea>
								<textarea class="text" name="alamat_tinggal" placeholder="Alamat Tinggal Anda" required></textarea>
							</div>
							<div class="col-lg-3">
								<div class="files">
									<div class="infos">
										<i class="bi bi-file-earmark-zip"></i>
										<h5>Unggah Files</h5>
										<p>Maksimal file 5MB .zip</p>
									</div>
									<input type="file" name="file" required>
								</div>
							</div>
						</div>
						<div class="row justify-content-end">
								<button class="btn" type="submit">Kirim Berkas</button>
						</div>
					</div>
				</form>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

@include('layouts.profile.footer')