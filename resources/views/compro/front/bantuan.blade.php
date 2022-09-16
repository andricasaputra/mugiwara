@extends('compro.front.main')

@section('title')
    Bantuan
@endsection

@section('content')

<section id="bantuan" class="bantuan">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="content"></div>
                <h1 class="display-4">Selesaikan semua pertanyaan dalam waktu singkat</h1>
                <form action="" method="POST">
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
            <div class="col-lg-6 bantuan-list-items">
                <h2>Sering ditanyakan</h2>
                <div id="seringDiTanyakan"></div>
				<ul id="data">
                    @foreach ($pertanyaans as $item)
                        <li><a href={{ route('readPertanyaan', $item->id) }}">{{ $item->keterangan }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6 bantuan-list-items" id="pertanyaan_lain">
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
                        <input type="file" name="files" required>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <button class="btn" type="button">Kirim</button>
            </div>
        </div>
    </div>
</section>

@endsection
