@extends('compro.front.main')

@section('title')
    Baca Berita
@endsection

@section('content')

<section id="read" class="read">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1>{{$posts->title}}</h1>
            </div>
        </div>
        <div class="row">
            <p>{{$posts->created_at}}
            <span class="badge">Informasi</span></p>
        </div>
        <div class="row">
            <img class="img-fluid" src="{{ asset('storage/posts/' .  $posts->image) }}">
        </div>
    </div>
</section>

<section id="news-content" class="news-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
				<p class="mb-5">{{ $posts->body }}</p>
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

                    @foreach ($lains as $item)

                        <div class="swiper-slide">
                            <div class="news-items">
                                <a href="{{$item->id}}">
                                    <div class="card">
                                        <div class="card-img-top">
                                            <img class="img-fluid" src="{{ asset('storage/posts/' .  $item->image) }}">
                                        </div>
                                        <div class="card-body">
                                            <h5>{{$item->title}}</h5>
									        <p style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis">{{$item->body}} </p>
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
