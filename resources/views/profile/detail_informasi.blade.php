@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

        <section id="read" class="read">
			<div class="container">
				<div class="row">
					<div class="col-8">
						<h1>{{$informasi->title}}</h1>
					</div>
				</div>
				<div class="row">
					<p>{{\Carbon\Carbon::parse($informasi->created_at)->format('d F Y')}} <span class="badge">Informasi</span></p>
				</div>
				<div class="row">
					<img class="img-fluid" src="{{ url('storage/posts/'. $informasi->image) }}">
				</div>
			</div>
		</section>

        <section id="news-content" class="news-content">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<p class="mb-5">{{$informasi->body}}</p>
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
                                @if(count($informasiAll)>0)
                                    @foreach($informasiAll as $k => $i)
                                    <div class="swiper-slide">
                                        <div class="news-items">
                                            <a href="{{ route('profile.informasi.detail', $i->slug) }}">
                                                <div class="card">
                                                    <div class="card-img-top">
                                                        <img class="img-fluid" src="{{ url('storage/posts/'. $i->image) }}">
                                                    </div>
                                                    <div class="card-body">
                                                        <h5>{{$i->title}}</h5>
                                                        <p>{{(strlen($i->body) > 13) ? substr($i->body,0,100).'...' : $i->body}}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
								
							</div>
						</div>

				</div>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

	@include('layouts.profile.footer')

	