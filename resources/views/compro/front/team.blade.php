@extends('compro.front.main')

@section('title')
    Tentang Kami
@endsection

@section('content')

<section id="team" class="team">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h1>Tim Pendiri CapsuleInn</h1>
                <p>Mereka adalah orang orang hebat yang bisa merubah masalah menjadi solusi, dengan menghadirkan aplikasi CapsuleInn. memudahkan pencarian tempat menginap dimanapun lokasi anda di Indonesia.</p>
            </div>
            <div class="col-lg-5">
                <img class="img-fluid" src="{{ asset('assets/img/' . $teams?->gambar) }}">
            </div>
        </div>
    </div>
</section>

<section id="list-teams" class="list-teams">
    <div class="container">
        <div class="row">

            @foreach ($teamHeaders as $item)

            <div class="col-lg-4 list-teams-list">
                <div class="card">
                    <img class="card-img-top" src="{{ asset('images/compro/team_header/'. $item?->gambar ?? '') }}">
                    <div class="card-body">
                        <h2>{{ $item?->heading }}</h2>
                        <h5>{{ $item?->jabatan }}</h5>
                        <div>
                            <i class="bi bi-{{ $item?->gambar_sosmed }}"></i>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>
</section>

<section id="founder" class="founder">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img class="img-fluid" src="{{ asset('images/compro/team_header/'. $teams?->gambar) }}">
            </div>
            <div class="col-lg-6">
                <h2>{{ $teams?->heading }}</h2>
                <h5>{{ $teams?->jabatan }}</h5>
                <p>{{ $teams?->keterangan }}</p>
            </div>
        </div>
    </div>
</section>

<section id="visi" class="visi">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 visi-items">
                <h2>Visi</h2>
                <div class="accordion">

                    @php
                        $no = 0;
                    @endphp
                        @foreach ($visis as $item)
                    @php
                        $no++;
                    @endphp

                    <div class="accordion-items active">
                        <div class="accordion-heading">
                            <h6>{{ $no }}. {{ $item->heading }}</h6>
                            <i class="bi bi-caret-up"></i>
                        </div>
                        <div class="accordion-content">
                            <p>{{ $item->keterangan }}</p>
                        </div>
                    </div>

                    @endforeach

                </div>

                <h2>Misi</h2>

                <div class="accordion">
                    @php
                        $no = 0;
                    @endphp
                        @foreach ($misis as $item)
                    @php
                        $no++;
                    @endphp
                    <div class="accordion-items">
                        <div class="accordion-heading">
                            <h6>{{ $no }}. {{ $item->heading }}</h6>
                            <i class="bi bi-caret-up"></i>
                        </div>
                        <div class="accordion-content">
                            <p>{{ $item->keterangan }}</p>
                        </div>
                    </div>

                    @endforeach

                </div>

            </div>
            <div class="col-lg-6 visi-items">
                <img class="img-fluid" src="./assets/img/ide.png">
            </div>
        </div>
    </div>
</section>

@endsection

