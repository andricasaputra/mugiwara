@extends('compro.front.main')

@section('title')
    Hotel
@endsection

@section('content')

<section id="hotel" class="hotel">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-8 hotel-items">
                <div class="hotel-top">
                    <img class="img-fluid" src="{{ asset('storage/rooms/' .  $images->image) }}">
                    <div class="caps">
                        <h2>{{ $images->name }}</h2>
                        <div class="starts">
                            @for ($i = 0; $i < $images->rating; $i++)
                                <img class="img-rating" src="{{ asset('assets/img/bintang.png') }}">
                            @endfor
                        <span>{{ $images->rating }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 hotel-items">
                <div class="card">
                    <form action="" method="POST">
                        <h2>Cek Ketersedian Kamar</h2>
                        <input required type="date" name="kapan" id="kapan" title="Choose your desired date" min="<?php echo date('Y-m-d'); ?>"/>
                        <button class="btn" onclick="cariAvailable()" type="button">Cari Kamar</button>
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
                    @foreach ($types as $item)
                        <li><button type="button" onclick="cariHotelKategori('{{ $item->name }}')" class="btn">{{ $item->name }}</button></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-9 hotels" id="card">

                {{-- ============ --}}
                @foreach ($hotels as $item)
                    <div class="card">
                        <div class="card-img">
                            <img class="card-img-top" src="{{ asset('storage/rooms/' .  $item->image) }}">
                            <div class="link-action">
                                @foreach ($playstores as $items)
                                    <a href="{{ $items->url }}" class="btn btn-sm btn-redirect"><img src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
                                @endforeach
                                @foreach ($playstores as $items)
                                    <a href="{{ $items->url }}" class="btn btn-sm btn-redirect"><img src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="starts">
                                <span class="badge badge-secondary">{{ $item->name }}</span>
                                @for ($i = 0; $i < $item->rating; $i++)
                                    <img class="start" src="./assets/img/bintang.png">
                                @endfor
                                <span>{{ $item->rating }}</span>
                            </div>
                            <h3>{{ $item->nama_hotel }}</h3>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="card">
                    <div class="card-img">
                        <img class="card-img-top" src="./assets/img/hotel3.png">
                    </div>
                    <div class="card-body">
                        <div class="starts">
                            <span class="badge badge-secondary">VIP</span>
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <span>4.6</span>
                        </div>
                        <h3>Hotel Emersia</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img class="card-img-top" src="./assets/img/hotel4.png">
                    </div>
                    <div class="card-body">
                        <div class="starts">
                            <span class="badge badge-secondary">VIP</span>
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <span>4.3</span>
                        </div>
                        <h3>Hotel Sheraton</h3>
                    </div>
                </div>

                <div class="card">
                    <div class="card-img">
                        <img class="card-img-top" src="./assets/img/hotel5.png">
                    </div>
                    <div class="card-body">
                        <div class="starts">
                            <span class="badge badge-secondary">VIP</span>
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <img class="start" src="./assets/img/bintang.png">
                            <span>4.8</span>
                        </div>
                        <h3>Hotel Novotel Lampung</h3>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>

<script>

    function cariHotelKategori(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            dataType: "json",
            data: {"cari": e},
            url: "{{ route('cariHotelKategori') }}",
            success : function(res){
                if(res.data == 'ada') {
                    let hotels = res.hotels
                    let ratings = res.ratings
                    var jml_start = "";
                    var rating = "";




                    console.log(jml_start)
                    let html_umar = ""
                    for (let index = 0; index < 4; index++) {
                        html_umar += `<img class="start" src="./assets/img/bintang.png">`

                    }
                    var html = "";
                    let start = ""
                    for(let i = 0; i < hotels.length; i++){
                        for(let j = 0; j < ratings.length; j++){
                            rating += `<img class="start" src="./assets/img/bintang.png">`
                        }
                        html += `<div class="card">
                    <div class="card-img">
                        <img class="card-img-top" src="storage/rooms/`+ hotels[i].image +`">
                    </div>
                    <div class="btn-action mt-2" style="margin-left: 60px">
                        @foreach ($playstores as $items)
                            <a href="{{ $items->url }}" type="button" class="btn btn-sm btn-redirect"><img width="10" src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
                        @endforeach
                        @foreach ($appstores as $items)
                            <a href="{{ $items->url }}" type="button" class="btn btn-sm btn-redirect"><img width="10" src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
                        @endforeach
                </div>

                    <div class="card-body">
                        <div class="starts">
                            <span class="badge badge-secondary">`+ hotels[i].name +`</span>
                                @for ($i = 0; $i < $item->rating; $i++)
                                    <img class="img-rating" src="{{ asset('assets/img/bintang.png') }}">
                                @endfor
                            <span>`+ hotels[0].rating +`</span>
                        </div>
                        <h3>`+ hotels[0].nama_hotel +`</h3>
                    </div>
                </div>`



                    }
                    $('#card').html(html)
                }
            }
        });

    }

    function cariAvailable() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        let kapan = $('#kapan').val();
        var html = "";

        $.ajax({
            type: "POST",
            dataType: "json",
            data: {"kapan": kapan},
            url: "{{ route('cariAvailable') }}",
            success : function(res){
                console.log(res)
                let room_availables = res.room_availables
                let start = ""
                for(let i = 0; i < room_availables.length; i++){
                    for(let j = 0; j < room_availables[i].rating; j++) {
                        start += `<img class="start" src="./assets/img/bintang.png">`
                    }
                    html += `<div class="card">
                        <div class="card-img">
                            <img class="card-img-top" src="storage/rooms/`+ room_availables[i].image +`">
                        </div>
                        <div class="btn-action mt-2 " style="margin-left: 60px">
                                @foreach ($playstores as $items)
                                    <a href="{{ $items->url }}" type="button" class="btn btn-sm mx-2"><img width="10" src="./assets/img/playstore.png"><span class="mx-3">Playstore</span></a>
                                @endforeach
                                @foreach ($appstores as $items)
                                    <a href="{{ $items->url }}" type="button" class="btn btn-sm mx-2"><img width="10" src="./assets/img/appstore.png"><span class="mx-3">Appstore</span></a>
                                @endforeach
                        </div>
                        <div class="card-body">
                            <div class="starts">
                                <span class="badge badge-secondary">`+ room_availables[i].name +`</span>
                                `+ start +`
                                <span>`+ room_availables[0].rating +`</span>
                            </div>
                            <h3>`+ room_availables[0].nama_hotel +`</h3>
                        </div>
                    </div>`
                }
                $('#card').html(html)

            }
        });
    }


</script>

@endsection
