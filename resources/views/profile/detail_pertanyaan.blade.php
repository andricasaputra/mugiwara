@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		<section id="mitra" class="mitra" style="padding-top: 0px!important;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>{{$pertanyaan->keterangan}}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        {{$pertanyaan->jawaban}}
                    </div>
                </div>
            </div>
        </section>

		@include('layouts.profile.bottom')

	</div>

	@include('layouts.profile.footer')

	