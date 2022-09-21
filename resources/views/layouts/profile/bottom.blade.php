<footer id="footer" class="footer">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						@if(!is_null($settings))
							@if(!is_null($settings->logo))
								<img class="img-fluid" src="{{url('images/compro/logo/' . $settings->logo)}}">
							@else
								<img class="img-fluid" src="{{url('assets/img/logo.png')}}">
							@endif	
						@else
								<img class="img-fluid" src="{{url('assets/img/logo.png')}}">
						@endif
					</div>
					@if(count($menu) != 0)
					<div class="col-lg-2">
						<h6 class="footer-title">Halaman</h6>
						<ul>
							@foreach($menu as $k => $m)
								<li><a href="{{ $m->url_menu }}">{{$m->nama_menu}}</a></li>
							@endforeach
						</ul>
					</div>
					@endif
					<div class="col-lg-4">
						<h6 class="footer-title">Kontak</h6>
						<ul>
							@if(!is_null($settings))
								<li>{{$settings->phone_number}}</li>
								<li>{{$settings->email}}</li>
							@endif
						</ul>

						<h6 class="footer-title mt-5">Sosial Media</h6>
						<div>
							@if(!is_null($settings))
								@if(!is_null($settings->facebook))
									<a class="sosial" href="{{$settings->facebook}}"><i class="bi bi-facebook"></i></a>
								@endif
								@if(!is_null($settings->facebook))
									<a class="sosial" href="{{$settings->facebook}}"><i class="bi bi-instagram"></i></a>
								@endif
								@if(!is_null($settings->facebook))
									<a class="sosial" href="{{$settings->facebook}}"><i class="bi bi-twitter"></i></a>
								@endif
							@endif
						</div>
					</div>
				</div>
				<div class="row copyright">
					<span>Copyright © 
						@if(!is_null($settings))
							@if(!is_null($settings->app_name))
								{{$settings->app_name}}
							@endif	
						@endif
					. All Rights Reserved</span>
					<span>|</span>
					<span>{{ date('Y') }}</span>
				</div>
			</div>
		</footer>