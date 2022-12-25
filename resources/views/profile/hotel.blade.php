@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

    	<section id="hotel" class="hotel">

		    <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-8 hotel-items" style="margin-bottom: 20px">
                        <div class="hotel-top">

                        	@if(!is_null($trending?->image))

                            	<img class="img-fluid" src="{{ asset('storage/accomodations/' . $trending?->image?->image) }}" style="width: 100%">
                            @else

                                @if(!is_null($trending?->room?->first()?->images?->first()?->image))

                                <img class="img-fluid" src="{{ asset('storage/rooms/' . $trending?->room?->first()?->images->first()?->image) }}" style="width: 100%">

                                @else

                                    <img class="img-fluid" src="{{ asset('storage/misc/no-image.png') }}" style="width: 100%">

                                @endif
                            	
                            @endif

                            <div class="caps">
                                <h2>{{ $trending?->name }}</h2>                         
                                <div class="starts">
                  	
                                	@foreach($trending?->reviews ?? [] as $review)
                                		<img class="start" src="{{ asset('compro/assets/img/bintang.png') }}">
                                	@endforeach

                                    <span>{{ $trending?->reviews?->avg('rating') }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 hotel-items">
                        <div class="card">
                            <form action="#" method="POST">
                                <h2 class="mt-4">Cek Ketersedian Kamar</h2>
                                <input type="date" name="tanggal" id="dateSearch" placeholder="Cari Kamar">
                                <button class="btn mb-4" type="button" id="searchHotel">Cari Kamar</button>
                            </form>
                        </div>
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
                        	<li><button type="button" class="btn btn-categories" data-category="all">Semua</button></li>
                            <li><button type="button" class="btn btn-categories" data-category="rekomendasi">Rekomendasi</button></li>
                            <li><button type="button" class="btn btn-categories" data-category="populer">Populer</button></li>
                            <li><button type="button" class="btn btn-categories" data-category="trending">Trending</button></li>
                        </ul>
                    </div>
                    <div class="col-lg-9 hotels">

                    	@foreach($accomodations as $accomodation)

                    		 <div class="card">
	                            <div class="card-img">

	                            	@if(file_exists(asset('/storage/accomodations/' . $accomodation->image?->image)))
		                            	<img class="card-img-top" src="{{ asset('/storage/accomodations/' . $accomodation->image?->image) }}" style="width: 100%; height: 100%">
		                            @else
		                            	<img class="card-img-top" src="{{ asset('/storage/rooms/' . $accomodation->room?->first()?->images?->first()?->image) }}" style="width: 100%; height: 100%">
		                            @endif

	                                <div class="link-action">
	                                    <a href="{{ $appstore->url }}" class="btn btn-sm btn-redirect"><img src="{{ asset('compro/assets/img/appstore.png') }}"><span class="mx-3">Appstore</span></a>
	                                    <a href="{{ $playstore->url }}" class="btn btn-sm btn-redirect"><img src="{{ asset('compro/assets/img/playstore.png') }}"><span class="mx-3">Playstore</span></a>
	                                </div>
	                            </div>
	                            <div class="card-body">
	                                <div class="starts">

	                                    <span class="badge badge-secondary">{{ $accomodation?->room?->first()?->type?->name }}</span>

	                                   @foreach($accomodation?->reviews as $review)
	                                		<img class="start" src="{{ asset('compro/assets/img/bintang.png') }}">
	                                	@endforeach
	                                    
	                                    <span>{{ $accomodation?->reviews?->avg('rating') ?? '' }}</span>
	                                </div>
	                                <h3>{{ $accomodation->name }}</h3>
	                            </div>
	                        </div>

	                

                    	@endforeach
                  
                    </div>
                </div>
            </div>
        </section>

  
    
		@include('layouts.profile.bottom')

	</div>

	@include('layouts.profile.footer')

