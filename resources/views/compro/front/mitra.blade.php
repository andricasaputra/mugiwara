@extends('compro.front.main')

@section('title')
    Mitra
@endsection

@section('content')

<section id="mitra" class="mitra">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h1>Yang telah bergabung dan menjadi mitra kami</h1>
                <p>Yakinkan diri anda untuk bergabung bersama kami, bangun peluang baru di sekitar anda</p>
            </div>
        </div>

        <div class="row">
            <div class="swiper slide-mitra">
                <div class="swiper-wrapper">

                    @foreach ($images_rooms as $item)
                        <div class="swiper-slide">
                            <img class="img-fluid" src="{{ asset('storage/rooms/' .  $item->image) }}">
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</section>

<section id="prasyarat" class="prasyarat">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 prasyarat-items">
                <h2>Proses Pendaftaran</h2>
                @php
                $no =0;
            @endphp
            @foreach ($prosesPendaftarans as $item)
            @php
                $no++;
            @endphp

                <div class="list"><span>{{$no}}</span><p>{{ $item->keterangan }}</p></div>

            @endforeach
            </div>

            <div class="col-lg-6 prasyarat-items">
                <h2>Syarat dan Dokumen</h2>
                @foreach ($unduhs as $item)
                    <div class="list"><span>1</span><p>Unduh dan setujuai dokumen persyaratan, <a href="{{ route('download', $item->id) }}">unduh dakumen</a></p></div>
                    @endforeach

                    @php
                        $no =1;
                    @endphp
                    @foreach ($syarats as $item)

                    @php
                        $no++;
                        @endphp
                    <div class="list"><span>{{$no}}</span><p>{{ $item->keterangan }}</p></div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section id="join" class="join">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 text-center">
                <h1 class="display-4">Awali perubahan dari sekarang</h1>
                <a class="btn"
                @foreach ($tombols as $item)
                    @php
                        $status = $item->status
                    @endphp
                    @if ($status == "off")
                        href="javascript:void(0)"
                    @endif
                    @if ($status == "on")
                        href="{{ route('gabung') }}"
                    @endif
                @endforeach
                ">Gabung Sekarang</a>
            </div>
        </div>
    </div>
</section>

@endsection
