@extends('compro.front.main')

@section('title')
    Baca Jawaban
@endsection

@section('content')

<section id="read" class="read">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1></h1>
            </div>
        </div>
        <div class="row">
            <p>{{$pertanyaans->created_at}}
            <span class="badge">Jawaban</span></p>
        </div>
    </div>
</section>

<section id="news-content" class="news-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
				<p class="mb-5"><p class="mb-5">{{$pertanyaans->jawaban}}</p></p>
            </div>
        </div>
    </div>
</section>


@endsection
