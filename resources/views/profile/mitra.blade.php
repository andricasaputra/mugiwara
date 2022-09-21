@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		@if(count($mitraSection) != 0)
			@foreach($mitraSection as $key => $m)
				@if($m->section == 1)
				<section id="mitra" class="mitra">
					<div class="container">
						<div class="row mb-5">
							<div class="col-lg-6">
								<h1>{{$m->title}}</h1>
								<p>{{$m->description}}</p>
							</div>
						</div>

						<div class="row">
							<div class="swiper slide-mitra">
								<div class="swiper-wrapper">
									@if(count($sliderMitra) != 0)
										@foreach($sliderMitra as $k => $s)
										<div class="swiper-slide">
											<img class="img-fluid" src="{{url('images/compro/slider_mitra/' . $s->gambar)}}">
										</div>
										@endforeach
									@endif
								</div>
							</div>
						</div>

					</div>
				</section>
				@endif
			@endforeach
		@endif

		@if(count($pendaftaran) !== 0 or count($syarat) != 0)
		<section id="prasyarat" class="prasyarat">
			<div class="container">
				<div class="row">
					@if(count($pendaftaran) != 0)
						<div class="col-lg-6 prasyarat-items">
							<h2>Proses Pendaftaran</h2>
							@php($counter=1)
							@foreach($pendaftaran as $k => $p)
								<div class="list">
									<span>{{$counter++}}</span><p>{{$p->text}}&nbsp;</p>
									@if(!is_null($p->file))
										<p><a href="{{url('images/compro/pendaftaran/' . $p->file)}}">Unduh</a></p>
									@endif
								</div>
							@endforeach
						</div>
					@endif

					@if(count($syarat) != 0)
					<div class="col-lg-6 prasyarat-items">
						<h2>Syarat dan Dokumen</h2>
						@php($counter=1)
						@foreach($syarat as $k => $s)
							<div class="list">
								<span>{{$counter++}}</span><p>{{$s->text}}&nbsp;</p>
								@if(!is_null($s->file))
									<p><a href="{{url('images/compro/syarat/' . $s->file)}}">Unduh</a></p>
								@endif
							</div>
						@endforeach
					</div>
					@endif
				</div>
			</div>
		</section>
		@endif

		@if(count($mitraSection) != 0)
			@foreach($mitraSection as $key => $m)
				@if($m->section == 2)
				<section id="join" class="join">
					<div class="container">
						<div class="row justify-content-center align-items-center">
							<div class="col-lg-6 text-center">
								<h1 class="display-4">{{$m->title}}</h1>
								<a class="btn" href="{{ route('profile.register') }}">Gabung Sekarang</a>
							</div>
						</div>
					</div>
				</section>
				@endif
			@endforeach
		@endif

		@include('layouts.profile.bottom')

	</div>

	@include('layouts.profile.footer')