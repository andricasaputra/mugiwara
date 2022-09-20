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
							@if(count($pertanyaan)!=0)
								@foreach($pertanyaan as $k => $p)
								<li><a href="./tips.html">{{$p->keterangan}}</a></li>
								@endforeach
							@endif
						</ul>
					</div>
					<div class="col-lg-6 bantuan-list-items">
						<h2>Pertanyaan lain</h2>
						<ul>
							@if(count($lainnya)!=0)
								@foreach($lainnya as $k => $p)
								<li><a href="{{route('profile.bantuan.pertanyaan.detail', $p->id)}}">{{$p->keterangan}}</a></li>
								@endforeach
							@endif
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section id="bantuan-form" class="bantuan-form">
			<div class="container">
				<form action="{{route('admin.hubungiKami.store.hubungiKami')}}" enctype="multipart/form-data" method="post">
					@csrf
					<div class="form">
						<h2>Hubungi Kami</h2>
						@if(session()->has('error'))
							<div class="alert alert-danger">{{ session()->get('error') }}</div>
						@endif
						@if(session()->has('success'))
							<div class="alert alert-success">{{ session()->get('success') }}</div>
						@endif
						<div class="row">
							<div class="col-lg-6">
								<input class="input" type="text" name="nama_lengkap" placeholder="Nama Lengkap">
							</div>
							<div class="col-lg-6">
								<input class="input" type="email" name="email" placeholder="Email">
							</div>
							<div class="col-12">
								<input class="input" type="text" name="judul_pertanyaan" placeholder="Judul Bantuan">
							</div>
							<div class="col-lg-9">
								<textarea class="text" name="pertanyaan" placeholder="Jelaskan Pertanyaan Anda"></textarea>
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
							<button class="btn" type="submit">Kirim</button>
						</div>
					</div>
				</form>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

@include('layouts.profile.footer')