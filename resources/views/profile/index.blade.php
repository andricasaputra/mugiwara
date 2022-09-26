@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		@if(count($beranda) != 0)
			@foreach($beranda as $b)
				@if($b->section == 1)
					<section id="avatar" class="avatar">
						<div class="container">
							<div class="row justify-content-between">
								<div class="col-lg-6">
									<h1>{{$b->title}}</h1>
									<p>{{$b->description}}</p>
									<div class="btn-action">
										@if(!is_null($settingAppStore))
											<a id="appstore"  href="{{$settingAppStore->url}}" class="btn mx-lg-2"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
										@endif
										@if(!is_null($settingPlayStore))
											<a id="playstore" href="{{$settingPlayStore->url}}" class="btn mx-lg-2"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
										@endif
									</div>
								</div>
								<div class="col-lg-5">
									<div class="swiper mySwiper">
										<div class="swiper-wrapper">
											@foreach($sliders as $slider)
												<div class="swiper-slide">
													<img class="img-fluid" src="{{ url('images/compro/slider/' . $slider->gambar ) }}" />
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

		@if(count($overview) != 0)
		<section id="calculed" class="calculed">
			<div class="container">
				<div class="row">
					@foreach($overview as $k => $o)
					<div class="col-lg-4 items-calculed">
						<h1 class="display-4">{{$o->count}}</h1>
						<p>{{$o->description}}</p>
					</div>
					@endforeach
				</div>
			</div>
		</section>
		@endif

		@if(count($beranda) != 0)
			@foreach($beranda as $b)
				@if($b->section == 2)
				<section id="quotes" class="quotes">
					<div class="container">
						<div class="row">
							<div class="col-lg-6">
								<h2>{{$b->title}}</h2>
								<p>{{$b->description}}</p>
							</div>
							<div class="col-lg-6">
								@if(!is_null($b->file))
									<img src="{{ url('images/compro/beranda/'. $b->file) }}">
								@endif
							</div>
						</div>			
					</div>
				</section>
				@endif
			@endforeach
		@endif

		@if(count($beranda) != 0)
			@foreach($beranda as $b)
				@if($b->section == 3)
					<section id="quotes" class="quotes tow">
						<div class="container">
							<div class="row">
								<div class="col-lg-6">
									@if(!is_null($b->file))
										<img src="{{ url('images/compro/beranda/'. $b->file) }}">
									@endif
								</div>
								<div class="col-lg-6">
									<h2>{{$b->title}}</h2>
									<p>{{$b->description}}</p>
								</div>
							</div>
						</div>
					</section>
				@endif
			@endforeach
		@endif

		@if(count($beranda) != 0)
			@foreach($beranda as $b)
				@if($b->section == 4)
				<section id="fiture" class="fiture">
					<div class="container">
						<div class="row">
							<div class="col-lg-6">
								<h2>{{$b->title}}</h2>
								<p>{{$b->description}}</p>
							</div>
						</div>

						@if(count($fitur) != 0)
						<div class="row mt-5">
							@foreach($fitur as $f)
								<div class="col-lg-4 fiture-items">
									<div class="card-fitures">
										<div class="icon-tag">
											<img class="img-fluid" src="{{url('images/compro/slider_fitur/' . $f->gambar)}}">
											<h3>{{$f->heading}}</h3>
										</div>
										<p>{{$f->keterangan}}</p>
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

		@if(count($beranda) != 0)
			@foreach($beranda as $b)
				@if($b->section == 5)
				<section id="ratings" class="ratings">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-6">
								<h2 class="text-center">{{$b->title}}</h2>
							</div>
						</div>
						@if(count($review) != 0)
						<div class="row">
							<div class="swiper slide-ratings">
								<div class="swiper-wrapper">
									@foreach($review as $key => $r)
									<div class="swiper-slide">
										<div class="card" style="min-height:350px!important;">
											<div class="card-body">
												<img class="img-fluid" src="{{ url('storage/avatars/' . $r->user?->account?->avatar) }}">
												<h5>{{$r->name}}</h5>
												<div class="ranting">
													@for($i=0;$i<round($r->rating);$i++)
														<i class="fa-solid fa-star" style="color:yellow;"></i>
													@endfor
												</div>
												<p>Costumer</p>
												<p>{{$r->comment}}</p>
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

		@if(count($beranda) != 0)
			@foreach($beranda as $b)
				@if($b->section == 6)
				<section id="news" class="news">
					<div class="container">
						<div class="row justify-content-center">
							<div class="col-lg-6">
								<h2>{{$b->title}}</h2>
							</div>
						</div>

						@if(count($informasi) != 0)
						<div class="row">
							<div class="swiper slide-news">
								<div class="swiper-wrapper">
									@foreach($informasi as $key => $i)
									<div class="swiper-slide">
										<div class="news-items">
											<a href="{{ route('profile.informasi.detail', $i->slug) }}">
												<div class="card" style="min-height: 200px!important;">
													<div class="card-img-top">
														<img class="img-fluid" src="{{ url('storage/posts/'. $i->image) }}">
													</div>
													<div class="card-body">
														<h5>{{$i->title}}</h5>
														<p>{!!(strlen($i->body) > 13) ? substr($i->body,0,25).'...' : $i->body!!}</p>
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

	