@include('layouts.profile.header')

<div class="page-wrapper">

	@include('layouts.profile.navbar')

	<section id="hotel" class="hotel">
		<div class="container">
			<div class="row mb-5">
				@if(!is_null($accomodationTop) and !is_null($accomodationTopImage))
				<div class="col-lg-8 hotel-items">
					<div class="hotel-top">
						<img class="img-fluid" src="{{ url('storage/accomodations/' . $accomodationTopImage?->image) }}">
						<div class="caps">
							<h2>{{$accomodationTop->name}}</h2>							
							<div class="starts">
								<img class="start" src="{{url('assets/img/bintang/'.round($accomodationTopRate->avgRating).'.png')}}'">
								<span>{{$accomodationTopRate->avgRating}}</span>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if(!is_null($accomodationTop) and !is_null($accomodationTopImage))
				<div class="col-lg-4 hotel-items">
					<div class="card">
				@else
				<div class="col-lg-12 hotel-items">
					<div class="card" style="padding:20px;">
				@endif
						<form action="" method="POST">
							<h2>Cek Ketersedian Kamar</h2>
							<input type="date" name="tanggal" class="date-input" placeholder="Cari Kamar">
							<button class="btn btn-cari-kamar" type="button">Cari Kamar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section id="list-hotel" class="list-hotel mb-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 res-check-left">
					
				</div>
				<div class="col-lg-9 hotels res-check-right">
					
				</div>
			</div>
		</div>
	</section>

	<section id="list-hotel" class="list-hotel">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<h3>Kategori</h3>
					<ul>
						@if(count($kategori) != 0)
							@foreach($kategori as $k => $kat)
							<li><button type="button" class="btn">{{$kat->name}}</button></li>
							@endforeach
						@endif
					</ul>
				</div>
				<div class="col-lg-9 hotels hotels-init">
					
				</div>
			</div>
		</div>
	</section>

	@include('layouts.profile.bottom')

</div>

@include('layouts.profile.footer')

<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url: "{{route('profile.accomodation.top')}}",
			method: "get",
			success: function(res){
				if(res.accomodationById.length>0){
					res.accomodationById.map((i) => {
						let card = `
							<div class="card">
								<div class="card-img">
									<img class="card-img-top" src="./assets/img/hotel4.png">
									<div class="link-action">
										<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
										<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
									</div>
								</div>
								<div class="card-body">
									<div class="starts">
										<span class="badge badge-secondary">VIP</span>
										<img class="start" src="./assets/img/bintang.png">
										<span>4.3</span>
									</div>
									<h3>${i.name}</h3>
								</div>
							</div>
						`
						$('.hotels-init').append(card);
					})
				}
			}
		})

		$('.btn-cari-kamar').on('click', function(){
			let date = $('.date-input').val();
			let payload = {
				date: date,
			}
			$('.title-check').remove();
			let html = `
				<h2 class="title-check">Ketersediaan Kamar</h2>
				`
			$('.res-check-left').append(html)
			$.ajax({
				url: "{{route('profile.room.check')}}",
				method: "post",
				data: payload,
				success: function(res){
					if(res.data.length>0){
						res.data.map((i)=>{
							let image = `{{url('storage/rooms/:image')}}`
							image = image.replace(':image', i.image);
							let card = `
								<div class="card">
									<div class="card-img">
										<img class="card-img-top" src="${image}">
										<div class="link-action">
											<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
											<a href="" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
										</div>
									</div>
									<div class="card-body">
										<div class="starts">
											<span class="badge badge-secondary">VIP</span>
											<img class="start" src="./assets/img/bintang.png">
											<span>${Math.round(i.reviews_avg_rating)}</span>
										</div>
										<h3>${i.name}</h3>
									</div>
								</div>
							`
							$('.res-check-right').append(card)
						})
					}
				}
			})
		})

	})
</script>