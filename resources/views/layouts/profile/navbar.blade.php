<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
			<div class="container nav-flay">
				<a class="navbar-brand" href="{{ route('profile.home') }}">
					@if(!is_null($settings))
						@if(!is_null($settings->logo))
							<img src="{{url('images/compro/logo/' . $settings->logo)}}">
						@else
							<img src="{{url('assets/img/logo.png')}}">
						@endif	
					@else
						<img class="img-fluid" src="{{url('assets/img/logo.png')}}">
					@endif
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse justify-content-end" id="navbar">
					<div class="navbar-nav">
						@if(count($menu) != 0)
							@foreach($menu as $k => $m)
								<a class="nav-link {{url()->full() == $m->url_menu ? 'active' : ''}}" href="{{ $m->url_menu }}">{{$m->nama_menu}}</a>
							@endforeach
						@endif
						<a class="nav-link only" href="{{route('login')}}">Masuk</a>
					</div>
				</div>
			</div>
		</nav>

		<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasExampleLabel">
					<a class="navbar-brand" href="#">
					@if(!is_null($settings))
						@if(!is_null($settings->logo))
							<img src="{{url('images/compro/logo/' . $settings->logo)}}">
						@else
							<img src="{{url('assets/img/logo.png')}}">
						@endif	
					@endif
				</a>
				</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="navbar-nav">
					@if(count($menu) != 0)
						@foreach($menu as $k => $m)
							<a class="nav-link {{url()->full() == $m->url_menu ? 'active' : ''}}" href="{{ $m->url_menu }}">{{$m->nama_menu}}</a>
						@endforeach
					@endif
					<a class="nav-link only" href="{{ route('login') }}">Masuk</a>
				</div>
			</div>
		</div>