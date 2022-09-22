@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		<section id="mitra" class="mitra">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-lg-6">
                        <h1>{{$informasi->title}}</h1>
                        <p>{{$informasi->body}}</p>
                    </div>
                </div>

                <div class="row">
                    <div class="swiper slide-mitra">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img class="img-fluid" src="{{ url('storage/posts/'. $informasi->image) }}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

		@include('layouts.profile.bottom')

	</div>

	@include('layouts.profile.footer')

	