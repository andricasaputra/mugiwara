@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    @include('layouts.multistepformcss')
                    <div>
                        <div id="multi-step-form-container">
                            <!-- Form Steps / Progress Bar -->
                            <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                                <!-- Step 1 -->
                                <li class="form-stepper-active text-center form-stepper-list" step="1">
                                    <a class="mx-2">
                                        <span class="form-stepper-circle">
                                            <span>1</span>
                                        </span>
                                        <div class="label">Detail Informasi Penginapan</div>
                                    </a>
                                </li>
                                <!-- Step 2 -->
                                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                                    <a class="mx-2">
                                        <span class="form-stepper-circle text-muted">
                                            <span>2</span>
                                        </span>
                                        <div class="label text-muted">Informai Detail Kamar</div>
                                    </a>
                                </li>
                                <!-- Step 3 -->
                                <li class="form-stepper-unfinished text-center form-stepper-list" step="3">
                                    <a class="mx-2">
                                        <span class="form-stepper-circle text-muted">
                                            <span>3</span>
                                        </span>
                                        <div class="label text-muted">Foto Kamar</div>
                                    </a>
                                </li>
                            </ul>

                            @include('inc.message')
                            <!-- Step Wise Form Content -->
                            <form action="{{ route('accomodations.store') }}" method="post">

                                <input type="hidden" name="image_type" value="room">
                                <!-- Step 1 Content -->
                                <section id="step-1" class="form-step">
                                    <h3 class="font-normal">Detail Informasi Penginapan</h3>
                                    <!-- Step 1 input fields -->
                                    <div class="mt-3">
                                        @include('admin.booking.accomodations.section1')
                                    </div>
                                    <div class="mt-3">
                                        <button class="button btn-navigate-form-step" type="button" step_number="2">Selanjutnya</button>
                                    </div>
                                </section>
                                <!-- Step 2 Content, default hidden on page load. -->
                                <section id="step-2" class="form-step d-none">
                                    <h2 class="font-normal">Tambah Kamar</h2>
                                    <!-- Step 2 input fields -->
                                    <div class="mt-3">
                                       @include('admin.booking.accomodations.section2')
                                    </div>
                                    <div class="mt-3">
                                        <button class="button btn-navigate-form-step" type="button" step_number="1">Sebelumnya</button>
                                        <button class="button btn-navigate-form-step" type="button" step_number="3">Selanjutnya</button>
                                    </div>
                                </section>
                                <!-- Step 3 Content, default hidden on page load. -->
                                <section id="step-3" class="form-step d-none">
                                    <h2 class="font-normal">Foto Kamar</h2>
                                    <!-- Step 3 input fields -->
                                    <div class="mt-3">
                                        <input type="file" name="room_image[]" multiple required/>
                                        <p class="help-block">{{ $errors->first('room_image.*') }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <button class="button btn-navigate-form-step" type="button" step_number="2">Sebelumnya</button>
                                        <button class="button submit-btn" type="submit">Simpan</button>
                                    </div>
                                </section>
                            </form>
                        </div>
                    </div>

                    @include('layouts.multistepformjs')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

@section('link')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />

<style>
    .select2-selection__rendered {
    line-height: 10px !important;
    border-radius: 0 !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
    border-radius: 0 !important;
}
.select2-selection__arrow {
    height: 34px !important;
    border-radius: 0 !important;
}
</style>

@endsection

@section('scripts')

<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#js-example-basic-single').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        $('#js-example-basic-single-regencies').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        $('#js-example-basic-single-districts').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    });
</script>

<script>
    // Set default FilePond options
    FilePond.setOptions({
        server: {
            url: "{{ config('filepond.server.url') }}",
            headers: {
                'X-CSRF-TOKEN': "{{ @csrf_token() }}",
            }
        }
    });

    FilePond.create(document.querySelector('input[name="room_image[]"]'), {chunkUploads: true});


</script>



<script src="{{ asset('assets/js/jquery.priceformat.min.js') }}"></script>


<script>
    $('#element').priceFormat({
        prefix: 'Rp ',
        centsLimit: 0,
        thousandsSeparator: '.'
    });

    $(document).on('change', '.province', function(){

        const id = $(this).val();

        $.ajax({
            url : `{{ route('api.regencies.show') }}/${id}`,
            success : function(res){

                $('.regencies').empty();

                $.each(res.regency, function (key, val) {
                    $('.regencies').append(optionsTemplate(val));
                });

                
            } 
        });

        
    });

    $(document).on('change', '.regencies', function(){

        const id = $(this).val();

        $.ajax({
            url : `{{ route('api.districts.show') }}/${id}`,
            success : function(res){

                $('.districts').empty();

                $.each(res.districts, function (key, val) {
                    $('.districts').append(optionsTemplate(val));
                });

                
            } 
        });

        
    });

    function optionsTemplate(data){

        return `<option value="${data.id}">${data.name}</option>`;
    }
</script>

@endsection