@extends('compro.front.main')

@section('title')
    Beranda
@endsection

@section('content')

<section id="avatar" class="avatar">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                @foreach ($awals as $item)

                <div class="col-lg-6">
                    <h1>{{ $item->heading }}</h1>
                    <p>{{ $item->keterangan }}</p>
                    <div class="btn-action">
                        @foreach ($appstores as $item)
                            <a href="{{ $item->url }}" type="button" class="btn btn-sm mx-2"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
                        @endforeach
                        @foreach ($playstores as $item)
                            <a href="{{ $item->url }}" type="button" class="btn btn-sm mx-2"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
                        @endforeach
                    </div>
                </div>

                @endforeach
            </div>
            <div class="col-lg-5">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($sliders as $item)
                            <div class="swiper-slide">
                                <img class="img-fluid" src="{{ asset('compro/assets/img/avatar.png') }}" />
                            </div>
                            <div class="swiper-slide">
                                <img class="img-fluid" src="{{ asset('images/compro/slider/'. $item->gambar)  }}" />
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
                <h1 class="display-4">{{ $data_jumlah_mitras }}+</h1>
                <p>Telah banyak mitra kami yang terpercaya den berada di beberapa wilayah Indonesia, seperti bandar lampung, dan juga medan.</p>
            </div>
            <div class="col-lg-4 items-calculed">
                <h1 class="display-4">{{ $data_jumlah_users }}+</h1>
                <p>Banyak pengguna telah termudahkan dengan adanya aplikasi CapsuleInn. tidak pelu takut kehabisan tempat saat bepergian.</p>
            </div>
            <div class="col-lg-4 items-calculed">
                <h1 class="display-4">{{ $data_jumlah_customers }}+</h1>
                <p>Team support yang selalu up time 24 jam dengan lebih dari 1000 layanan perhari, dapat membantu menyelesaikan masalah pengguna.</p>
            </div>
        </div>
    </div>
</section>

@foreach ($aboutPertamas as $item)

    <section id="quotes" class="quotes">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>{{ $item->heading }}</h2>
                    <p>{{ $item->keterangan }}</p>
                </div>
                <div class="col-lg-6">
                    <img src="{{ asset('images/compro/about_pertama/'. $item->gambar)  }}">
                </div>
            </div>
        </div>
    </section>

@endforeach

@foreach ($aboutKeduas as $item)

    <section id="quotes" class="quotes tow">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="./assets/img/orb.png">
                </div>
                <div class="col-lg-6">
                    <h2>{{ $item->heading }}</h2>
                    <p>{{ $item->keterangan }}</p>
                </div>
            </div>
        </div>
    </section>

    @endforeach

<section id="fiture" class="fiture">
    <div class="container">
        @foreach ($keteranganFiturs as $item)

				<div class="row">
                    <div class="col-lg-6">
                        <h2>{{ $item->heading }}</h2>
						<p>{{ $item->keterangan }} </p>
					</div>
				</div>

            @endforeach

        <div class="row mt-5">
            @foreach ($sliderFiturs as $item)
            <div class="col-lg-4 fiture-items">
                <div class="card-fitures">
                    <div class="icon-tag">
                        <img class="img-fluid" width="100" src="{{ asset('images/compro/slider_fitur/' . $item->gambar) }}">
                        <h3>{{ $item->heading }}</h3>
                    </div>
                    <p>{{ $item->keterangan }} </p>
                </div>
            </div>
            @endforeach

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

                    @foreach ($reviews as $item)

                    <div class="swiper-slide">
                            <div class="card">
                                <div class="card-body">
                                    <p> {{ $item->comment }}</p>
                                    <img class="img-fluid" src="{{ asset('storage/avatars/' .  $item->avatar) }}">
                                    <h5>{{ $item->name }}</h5>
                                    <div class="ranting">
                                        @for ($i = 0; $i < $item->rating; $i++)
                                            <img class="img-rating" src="{{ asset('assets/img/bintang.png') }}">
                                        @endfor
                                    </div>
                                    <p>{{ $item->type }}</p>
                                </div>
                            </div>
                    </div>

                    @endforeach

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

                    @foreach ($posts as $item)

                        <div class="swiper-slide">
                            <div class="news-items">
                                <a href="{{route('readBerita', $item->id)}}">
                                    <div class="card">
                                        <div class="card-img-top">
                                            <img class="img-fluid" src="{{ asset('storage/posts/' .  $item->image) }}">
                                        </div>
                                        <div class="card-body">
                                            <h5>{{ $item->title }}</h5>
                                            <p style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">{{ $item->descriptionbody }} </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        </div>
    </div>
</section>

@endsection
