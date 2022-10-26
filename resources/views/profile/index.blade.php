@include('layouts.profile.header')

<div class="page-wrapper">

    @include('layouts.profile.navbar')

    @if (count($beranda) != 0)
        @foreach ($beranda as $b)
            @if ($b->section == 1)
                <section id="avatar" class="avatar">
                    <div class="container">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <h1>{{ $b->title }}</h1>
                                <p>{{ $b->description }}</p>
                                <div class="btn-action">
                                    @if (!is_null($settingAppStore))
                                        <a id="appstore" href="{{ $settingAppStore->url }}" class="btn mx-lg-2"><img
                                                src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
                                    @endif
                                    @if (!is_null($settingPlayStore))
                                        <a id="playstore" href="{{ $settingPlayStore->url }}" class="btn mx-lg-2"><img
                                                src="./assets/img/playstore.png"><span
                                                class="mx-3">Playstore</span></a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="swiper mySwiper">
                                    <div class="swiper-wrapper">
                                        @foreach ($sliders as $slider)
                                            <div class="swiper-slide">
                                                <img class="img-fluid"
                                                    src="{{ url('storage/data/' . $slider->image) }}" />
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    @if (count($overview) != 0)
        <section id="calculed" class="calculed">
            <div class="container">
                <div class="row">
                    @foreach ($overview as $k => $o)
                        <div class="col-lg-4 items-calculed">
                            <h1 class="display-4">{{ $o->count }}</h1>
                            <p>{{ $o->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (count($beranda) != 0)
        @foreach ($beranda as $b)
            @if ($b->section == 2)
                <section id="quotes" class="quotes">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2>{{ $b->title }}</h2>
                                <p>{{ $b->description }}</p>
                            </div>
                            <div class="col-lg-6">
                                @if (!is_null($b->file))
                                    <img src="{{ url('images/compro/beranda/' . $b->file) }}">
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    @if (count($beranda) != 0)
        @foreach ($beranda as $b)
            @if ($b->section == 3)
                <section id="quotes" class="quotes tow">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                @if (!is_null($b->file))
                                    <img src="{{ url('images/compro/beranda/' . $b->file) }}">
                                @endif
                            </div>
                            <div class="col-lg-6">
                                <h2>{{ $b->title }}</h2>
                                <p>{{ $b->description }}</p>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    @if (count($beranda) != 0)
        @foreach ($beranda as $b)
            @if ($b->section == 4)
                <section id="fiture" class="fiture">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2>{{ $b->title }}</h2>
                                <p>{{ $b->description }}</p>
                            </div>
                        </div>

                        @if (count($fitur) != 0)
                            <div class="row mt-5">
                                @foreach ($fitur as $f)
                                    <div class="col-lg-4 fiture-items">
                                        <div class="card-fitures">
                                            <div class="icon-tag">
                                                <img class="img-fluid"
                                                    src="{{ url('images/compro/slider_fitur/' . $f->gambar) }}">
                                                <h3>{{ $f->heading }}</h3>
                                            </div>
                                            <p>{{ $f->keterangan }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    @if (count($beranda) != 0)
        @foreach ($beranda as $b)
            @if ($b->section == 5)
                <section id="ratings" class="ratings">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <h2 class="text-center">{{ $b->title }}</h2>
                            </div>
                        </div>
                        @if (count($review) != 0)
                            <div class="row">
                                <div class="swiper slide-ratings">
                                    <div class="swiper-wrapper">
                                        @foreach ($review as $key => $r)
                                            <div class="swiper-slide">
                                                <div class="card" style="min-height:350px!important;">
                                                    <div class="card-body">
                                                        <p>{{ $r->comment }}</p>
                                                        @if(!is_null($r->user?->google_id))

                                                            @if(strpos('http', $r->user?->account?->avatar))
                                                                <img class="img-fluid"
                                                            src="{{ $r->user?->account?->avatar ?? 'default_man.png' }}">
                                                            @else
                                                                <img class="img-fluid"
                                                            src="{{ url('storage/avatars/' . $r->user?->account?->avatar ?? 'default_man.png') }}">
                                                            @endif
                                                             
                                                        @else
                                                             <img class="img-fluid"
                                                            src="{{ url('storage/avatars/' . $r->user?->account?->avatar ?? 'default_man.png') }}">
                                                        @endif
                                                       
                                                        <h5>{{ $r->user?->name }}</h5>
                                                        <div class="ranting">
                                                            @for ($i = 0; $i < round($r->rating); $i++)
                                                                <i class="fa-solid fa-star" style="color:yellow;"></i>
                                                            @endfor
                                                        </div>
                                                        <p>Customer</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    @if (count($beranda) != 0)
        @foreach ($beranda as $b)
            @if ($b->section == 6)
                <section id="news" class="news">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <h2>{{ $b->title }}</h2>
                            </div>
                        </div>

                        @if (count($informasi) != 0)
                            <div class="row">
                                <div class="swiper slide-news">
                                    <div class="swiper-wrapper">
                                        @foreach ($informasi as $key => $berita)
                                            <div class="swiper-slide">
                                                <div class="news-items">
                                                    <a href="{{ route('profile.informasi.detail', $berita->slug) }}">
                                                        <div class="card" style="min-height: 200px!important;">
                                                            <div class="card-img-top">
                                                                <img class="img-fluid"
                                                                    src="{{ url('storage/posts/' . $berita->image) }}">
                                                            </div>
                                                            <div class="card-body">
                                                                <h5>{{ $berita->title }}</h5>
                                                                <p> {!! substr(strip_tags($berita->body), 0, 150) . '...' !!}</p>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            @endif
        @endforeach
    @endif

    @include('layouts.profile.bottom')

</div>

@include('layouts.profile.footer')
