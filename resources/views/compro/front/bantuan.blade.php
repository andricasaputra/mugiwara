<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://capsuleinn.id/assets/css/vertical-layout-light/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<link rel="stylesheet" href="{{ asset('compro/assets/css/main.css') }}">
	<title>Bantuan</title>
</head>
<body>

	<div class="page-wrapper">

		<nav class="navbar navbar-expand-lg fixed-top">
			<div class="container nav-flay">
				<a class="navbar-brand" href="{{ route('front') }}">
					<img src="{{ asset('compro/assets//img/logo.png') }}">

				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbar">
					<div class="navbar-nav">
						<a class="nav-link" href="{{ route('front') }}">Beranda</a>
							<a class="nav-link" href="{{ route('jadi.mitra') }}">Jadi Mitra</a>
							<a class="nav-link" href="{{ route('hotel') }}">Hotel</a>
							<a class="nav-link" href="{{ route('tentang') }}">Tentang Kami</a>
							<a class="nav-link active" href="{{ route('bantuan') }}">Bantuan</a>
                            <a class="nav-link only" href="{{route('login')}}">Masuk</a>
					</div>
				</div>
			</div>
		</nav>

		<section id="bantuan" class="bantuan">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="content"></div>
						<h1 class="display-4">Selesaikan semua pertanyaan dalam waktu singkat</h1>
						<form action="javascript:void(0)" method="postPOST">
							<input class="form-control" type="text" name="help" id="inpCariBantuan" placeholder="Cari bantuan">
							<i class="bi bi-search"></i>
						</form>
					</div>
				</div>
			</div>
		</section>

		<section id="bantuan-list" class="bantuan-list">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h2>Sering ditanyakan</h2>
                        <div id="seringDiTanyakan"></div>
						<ul id="data">
                            @foreach ($pertanyaans as $item)

                                <li><a href="/api/read_pertanyaan/{{ $item->id }}">{{ $item->keterangan }}</a></li>

                            @endforeach
						</ul>
					</div>
					<div class="col-lg-6" id="pertanyaan_lain">
						<h2>Pertanyaan lain</h2>
						<ul>
                            @foreach ($pertanyaanLains as $item)

                                <li><a href="/api/read_pertanyaan/{{ $item->id }}">{{ $item->keterangan }}</a></li>

                            @endforeach
						</ul>
					</div>
				</div>
			</div>
		</section>

		<section id="bantuan-form" class="bantuan-form">
			<div class="container">
                <form action="{{ route('store.hubungi') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form">
                        <h2>Hubungi Kami</h2>
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
                                    <input type="file" name="files">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-2">
                                <button class="btn" type="submit">Kirim</button>
                            </div>
                        </div>
                    </form>
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

    <script>
        $('#inpCariBantuan').on('keyup', function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            let cari = $('#inpCariBantuan').val();

            $.ajax({
                type: "POST",
                dataType: "json",
                data: {"cari": cari},
                url: "cari_bantuan/",
                success : function(res){
                    let cekData = res.data;
                    let pertanyaans = res.pertanyaans;
                    if(cekData == "kosong") {
                        var html = "";
                        for(let i = 0; i < pertanyaans.length; i++){
                            html += "<ul><li><a href='/api/read_pertanyaan/"+ pertanyaans[i].id +"'>"+ pertanyaans[i].keterangan +"</a></li></ul>"
                        }
                        document.getElementById('pertanyaan_lain').style.display = 'block';
                        document.getElementById('data').style.display = 'block';
                    }
                    if(cekData == "tidak kosong"){

                        var html = "";
                        for(let i = 0; i < pertanyaans.length; i++){
                            html += "<ul><li><a href='/api/read_pertanyaan/"+ pertanyaans[i].id +"'>"+ pertanyaans[i].keterangan +"</a></li></ul>"
                        }
                        document.getElementById('data').style.display = 'none';
                        document.getElementById('pertanyaan_lain').style.display = 'none';
                        $('#seringDiTanyakan').html(html)
                    }
                }
            });
        })

    </script>
</body>
</html>
