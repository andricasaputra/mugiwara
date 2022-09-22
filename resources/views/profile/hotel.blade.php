@include('layouts.profile.header')

<div class="page-wrapper">

	@include('layouts.profile.navbar')

	<section id="hotel" class="hotel">
		<div class="container">
			<div class="row mb-5">
				@if(!is_null($accomodationTop) and !is_null($accomodationTopImage))
				<div class="col-lg-8 hotel-items">
					<div class="hotel-top">
						<img class="img-fluid" src="{{url('storage/rooms/' . $accomodationTopImage)}}">
						<div class="caps">
							<h2>{{$accomodationTop->name}}</h2>							
							<div class="starts">
								<span>
									@for($i=0;$i<ceil($accomodationTopRate->avgRating);$i++)
										<i class="fa-solid fa-star" style="color:yellow;"></i>
									@endfor
								</span>
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

	<section id="list-hotel" class="list-hotel mb-5 list-hotel-check">
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
		<div class="container container-list">
			<div class="row">
				<div class="col-lg-3">
					<h3>Kategori</h3>
					<ul>
						@if(count($kategori) != 0)
							@foreach($kategori as $k => $kat)
							<li><button type="button" class="btn btn-category" data-category="{{$kat->name}}">{{$kat->name}}</button></li>
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
		var dtToday = new Date();
		var month = dtToday.getMonth() + 1;
		var day = dtToday.getDate();
		var year = dtToday.getFullYear();
		if(month < 10)
			month = '0' + month.toString();
		if(day < 10)
			day = '0' + day.toString();
		var maxDate = year + '-' + month + '-' + day;
		$('.date-input').attr('min', maxDate);
	})
</script>
<script>
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url: "{{route('profile.accomodation.top')}}",
			method: "post",
			data: {
				type: 'vvip',
			},
			success: function(res){
				if (res.status == 'success') {
					if (res.data.length > 0) {
						res.data.map((i) => {
							if (i.room.length > 0) {
								let type = '';
								let imageRoom = '';
								i.room.map((r) => {
									if (r.type !== null) {
										type = r.type.name
									}
									if (r.images.length > 0) {
										r.images.map((ri) => {
											imageRoom = ri.image
										})
									}
								})
								if (imageRoom!==''&&type!==''){
									let image = `{{url('storage/rooms/:image')}}`
									let rating = `{{url('assets/img/bintang:rating.png')}}`
									image = image.replace(':image', imageRoom);
									rating = rating.replace(':rating', Math.round(i.reviews_avg_rating));
									let card = `
										<div class="card card-hotels-init" style="min-height:250px!important;max-height:250px!important;">
											<div class="card-img">
												<img class="card-img-top" src="${image}">
												<div class="link-action">
													<a href="{{$settingAppStore->url}}" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
													<a href="{{$settingPlayStore->url}}" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
												</div>
											</div>
											<div class="card-body">
												<div class="starts">
													<span class="badge badge-secondary">${type}</span>
													<span class="rating-${i.id}-check"></span>
													<span>${Math.round(i.reviews_avg_rating)}</span>
												</div>
												<h3>${i.name}</h3>
											</div>
										</div>
									`
									$('.hotels-init').append(card);
									for(let j = 0;j < Math.round(i.reviews_avg_rating);j++) {
										$(`.rating-${i.id}-check`).append('<i class="fa-solid fa-star" style="color:yellow;"></i>')
									}
								}
							}
						})
					}
				}
			}
		})

		$('.btn-cari-kamar').on('click', function(){
			$('.container-list').remove();
			let date = $('.date-input').val();
			let payload = {
				date: date,
			}
			let html = `<h3 class="title-check">Ketersediaan Kamar</h3>`
			$('.card-res-check').remove();
			$('.title-check').remove();
			$('.res-check-left').append(html)
			$('html, body').animate({
				scrollTop: $(".list-hotel-check").offset().top - 170
			}, 1000);
			$('.fa-star-check').remove();
			$.ajax({
				url: "{{route('profile.room.check')}}",
				method: "post",
				data: payload,
				success: function(res){
					if(res.data.length>0){
						res.data.map((i)=>{
							if (i.available_room_count>0) {
								if (i.room.length > 0) {
									let type = '';
									let imageRoom = '';
									i.room.map((r) => {
										if (r.type !== null) {
											type = r.type.name
										}
										if (r.images.length > 0) {
											r.images.map((ri) => {
													imageRoom = ri.image
											})
										}
									})
									if (imageRoom!==''&&type!==''){
										let image = `{{url('storage/rooms/:image')}}`
										let rating = `{{url('assets/img/bintang:rating.png')}}`
										image = image.replace(':image', imageRoom);
										rating = rating.replace(':rating', Math.round(i.reviews_avg_rating));
										let card = `
											<div class="card card-res-check" style="min-height:250px!important;max-height:250px!important;">
												<div class="card-img">
													<img class="card-img-top" src="${image}">
													<div class="link-action">
														<a href="{{$settingAppStore->url}}" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
														<a href="{{$settingPlayStore->url}}" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
													</div>
												</div>
												<div class="card-body">
													<div class="starts">
														<span class="badge badge-secondary">${type}</span>
														<span class="rating-${i.id}"></span>
														<span>${Math.round(i.reviews_avg_rating)}</span>
													</div>
													<h3>${i.name}</h3>
												</div>
											</div>
										`
										$('.res-check-right').append(card);
										for(let j = 0;j < Math.round(i.reviews_avg_rating);j++) {
											$(`.rating-${i.id}`).append('<i class="fa-solid fa-star fa-star-check" style="color:yellow;"></i>')
										}
									}
								}
							}
						})
					}
				}
			})
		})

		$('.btn-category').on('click', function() {
			$('.card-hotels-init').remove();
			let category = $(this).data('category');
			$.ajax({
				url: "{{route('profile.accomodation.top')}}",
				method: "post",
				data: {
					type: category,
				},
				success: function(res){
					if (res.status == 'success') {
						if (res.data.length > 0) {
							res.data.map((i) => {
								if (i.room.length > 0) {
									let type = '';
									let imageRoom = '';
									i.room.map((r) => {
										if (r.type !== null) {
											if (r.type.name == category) {
												type = r.type.name
											}
										}
										if (r.images.length > 0) {
											r.images.map((ri) => {
												imageRoom = ri.image
											})
										}
									})
									if (imageRoom!=='' && type!==''){
										let image = `{{url('storage/rooms/:image')}}`
										let rating = `{{url('assets/img/bintang:rating.png')}}`
										image = image.replace(':image', imageRoom);
										rating = rating.replace(':rating', Math.round(i.reviews_avg_rating));
										let card = `
											<div class="card card-hotels-init" style="min-height:250px!important;max-height:250px!important;">
												<div class="card-img">
													<img class="card-img-top" src="${image}">
													<div class="link-action">
														<a href="{{$settingAppStore->url}}" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
														<a href="{{$settingPlayStore->url}}" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
													</div>
												</div>
												<div class="card-body">
													<div class="starts">
														<span class="badge badge-secondary">${type}</span>
														<span class="rating-${i.id}"></span>
														<span>${Math.round(i.reviews_avg_rating)}</span>
													</div>
													<h3>${i.name}</h3>
												</div>
											</div>
										`
										$('.hotels-init').append(card);
										for(let j = 0;j < Math.round(i.reviews_avg_rating);j++) {
											$(`.rating-${i.id}`).append('<i class="fa-solid fa-star" style="color:yellow;"></i>')
										}
									}
								}
							})
						}
					}
				}
			})
		})
	})
</script>