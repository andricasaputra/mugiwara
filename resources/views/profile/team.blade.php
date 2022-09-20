@include('layouts.profile.header')
	<div class="page-wrapper">
@include('layouts.profile.navbar')

		@if(count($tentang))
			@foreach($tentang as $k => $v)
				@if($v->section == 1)
				<section id="team" class="team">
					<div class="container">
						<div class="row justify-content-between">
							<div class="col-lg-6">
								<h1>{{$v->title}}</h1>
								<p>{{$v->description}}</p>
							</div>
							<div class="col-lg-5">
								<img class="img-fluid" src="{{url('images/compro/tentang/' . $v->image)}}">
							</div>
						</div>
					</div>
				</section>
				@endif
			@endforeach
		@endif

		@if(count($team)!=0)
			@foreach($team as $k => $t)
			<section id="list-teams" class="list-teams">
				<div class="container">
					<div class="row">
						<div class="col-lg-4 list-teams-list">
							<div class="card">
								<img class="card-img-top" src="{{url('images/compro/team_header/' . $t->gambar)}}">
								<div class="card-body">
									<h2>{{$t->heading}}</h2>
									<h5>{{$t->jabatan}}</h5>
									<!-- <div>
										<a href="#">
											<img src="{{url('images/compro/team_header/' . $t->gambar_sosmed)}}">
										</a>
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			@endforeach
		@endif

		@if(count($team)!=0)
			@foreach($team as $k => $t)
				@if(strtolower($t->jabatan) == 'founder')
				<section id="founder" class="founder">
					<div class="container">
						<div class="row">
							<div class="col-lg-6 founder-items">
								<img class="img-fluid" src="{{url('images/compro/team_header/' . $t->gambar)}}">
							</div>
							<div class="col-lg-6 founder-items">
								<h2>{{$t->heading}}</h2>
								<h5>{{ucfirst($t->jabatan)}}</h5>
								<p>{{$t->keterangan}}</p>
							</div>
						</div>
					</div>
				</section>
				@endif
			@endforeach
		@endif

		<section id="visi" class="visi">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 visi-items">
						<h2>Visi</h2>
						<div class="accordion">
							@if(count($visiMisi)!=0)
								@foreach($visiMisi as $k => $v)
									@if($v->kategori == 'visi')
									<div class="accordion-items">
										<div class="accordion-heading">
											<h6>{{$v->heading}}</h6>
											<i class="bi bi-caret-up"></i>
										</div>
										<div class="accordion-content">
											<p>{{$v->keterangan}}</p>
										</div>
									</div>
									@endif
								@endforeach
							@endif
						</div>

						<h2>Misi</h2>

						<div class="accordion">
							@if(count($visiMisi)!=0)
								@foreach($visiMisi as $k => $v)
									@if($v->kategori == 'misi')
										<div class="accordion-items">
											<div class="accordion-heading">
												<h6>{{$v->heading}}</h6>
												<i class="bi bi-caret-up"></i>
											</div>
											<div class="accordion-content">
												<p>{{$v->keterangan}}</p>
											</div>
										</div>
									@endif
								@endforeach
							@endif
						</div>

					</div>
					<div class="col-lg-6 visi-items">
						<img class="img-fluid" src="./assets/img/ide.png">
					</div>
				</div>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

@include('layouts.profile.footer')