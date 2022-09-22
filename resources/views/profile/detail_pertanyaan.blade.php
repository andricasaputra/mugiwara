@include('layouts.profile.header')

	<div class="page-wrapper">

		@include('layouts.profile.navbar')

		<!-- <section id="mitra" class="mitra" style="padding-top: 0px!important;">
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
        </section> -->
        <section id="bantuan" class="bantuan">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-10">
						<div class="content"></div>
						<h1 class="display-4">Selesaikan semua pertanyaan dalam waktu singkat</h1>
						<div class="d-flex mt-3">
							<span class="input-group-text bg-transparent" style="border-style: none!important;margin-right:-50px;z-index:2;" id="basic-addon1"><i class="bi bi-search"></i></span>
							<input class="form-control help-input" type="text" name="help" placeholder="Cari bantuan" style="z-index:1;">
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="bantuan-list">
			<div class="container result-search">
				
			</div>
		</section>

        <section id="bantuan-list" class="bantuan-list">
			<div class="container">
				<div class="row reading">
					<div class="col-lg-4 bantuan-list-items reading">
						<h2>Pertannya lain</h2>
						<ul>
                            @if(count($lainnya)>0)
                                @foreach($lainnya as $k => $l)
                                    <li><a href="{{route('profile.bantuan.pertanyaan.detail', $l->id)}}">{{$l->keterangan}}</a></li>
                                @endforeach
                            @endif
						</ul>
					</div>
					<div class="col-lg-8 bantuan-list-items">
						<h1 class="mb-5">{{$pertanyaan->keterangan}}</h1 class="display-4">
						<p>{{$pertanyaan->jawaban}}</p>
					</div>
				</div>
			</div>
		</section>

		@include('layouts.profile.bottom')

	</div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(){
		$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

		$('.help-input').on('keypress', function(e) {
			let payload = {
				param: $(this).val()
			}

			if(e.which == 13) {
				$('.bantuan-list-items').remove();
				let html = `
				<div class="col-lg-6 bantuan-list-items" style="padding-top:150px">
					<h2>Hasil Pencarian</h2>
					<ul class="list-hasil-search">
					</ul>
				</div>
				`
				$('.result-search').append(html)
				$('html, body').animate({
					scrollTop: $(".result-search").offset().top
				}, 1000);
				$.ajax({
					type: "post",
					data: payload,
					url: "{{ route('profile.bantuan.pertanyaan.search') }}",
					success: function(res) {
						$('.bantuan-list-items').remove();
						$('.result-search').append(html)
						if(res.data.length>0){
							res.data.map((i)=>{
								let val = i
								let route = `{{route('profile.bantuan.pertanyaan.detail', ":id")}}`
								route = route.replace(':id', val.id);
								let li = `<li><a href="${route}">${val.keterangan}</a></li>`
								$('.list-hasil-search').append(li)
							})
						}
					}
				})
			}
		})
	})
</script>
	@include('layouts.profile.footer')

	