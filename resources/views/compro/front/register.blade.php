@extends('compro.front.main')

@section('title')
    Submit
@endsection

@section('content')

<section id="form-register" class="form-register">
    <div class="container">
        <div class="form">
            @if (\Session::has('message'))
                <div class="alert alert-success">
                    <ul>
                        <li>Berhasil!!!</li>
                    </ul>
                </div>
            @endif
            <h2>Raih Sukses Bersama CapsuleInn</h2>
            <form action="{{ route('store.mitraGabung') }}" method="post" enctype="multipart/form-data">
                @csrf
            <div class="row">
                <div class="col-lg-6">
                    <input class="input" type="text" name="nama_lengkap" placeholder="Nama Lengkap">
                </div>
                <div class="col-lg-6">
                    <input class="input" type="email" name="email" placeholder="Email">
                </div>
                <div class="col-lg-6">
                    <input class="input" type="text" name="hp" placeholder="Nomor Telepon">
                </div>
                <div class="col-lg-6">
                    <input class="input" type="text" name="nik" placeholder="NIK">
                </div>
                <div class="col-lg-9">
                    <textarea class="text" name="alamat_tinggal" placeholder="Alamat Tempat Usaha"></textarea>
                    <textarea class="text" name="alamat_usaha" placeholder="Alamat Tinggal Anda"></textarea>
                </div>
                <div class="col-lg-3">
                    <div class="files">
                        <div class="infos">
                            <i class="bi bi-file-earmark-zip"></i>
                            <h5>Unggah Files</h5>
                            <p>Maksimal file 5MB .zip</p>
                        </div>
                        <input type="file" name="file">
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <button class="btn" type="submit">Kirim Berkas</button>
            </div>
            </form>
        </div>
    </div>
</section>

@endsection
