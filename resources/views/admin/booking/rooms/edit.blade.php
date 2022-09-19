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
                                        <div class="label">Ubah Informasi Kamar</div>
                                    </a>
                                </li>
                                <!-- Step 2 -->
                                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                                    <a class="mx-2">
                                        <span class="form-stepper-circle text-muted">
                                            <span>2</span>
                                        </span>
                                        <div class="label text-muted">Foto Kamar</div>
                                    </a>
                                </li>
                            </ul>
                            <!-- Step Wise Form Content -->
                            @include('inc.message')
                            <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST" action="{{ route('rooms.update', $accomodation?->id) }}">

                                @method('PUT')
                                @csrf

                                <input type="hidden" name="image_type" value="room">
                                <!-- Step 1 Content -->
                                <section id="step-1" class="form-step">
                                    <h3 class="font-normal">Detil Informasi Kamar</h3>
                                    <!-- Step 1 input fields -->
                                    <div class="mt-3">
                                        <div class="form-group">
                                            <label for="name">Nama Penginapan</label>
                                            <input name="name" type="text" class="form-control form-control-lg"  required value="{{ $accomodation->name }}" readonly>
                                        </div>
                                         <div class="form-group">
                                            <label for="status">Status Kamar</label>
                                            <select name="status" class="form-control">
                                                <option value="{{ $accomodation->room->first()?->status }}">{{ ucwords($accomodation->room->first()?->status) }}</option>
                                                <option value="available">Available</option>
                                                <option value="booked">Booked</option>
                                                <option value="stayed">Stayed</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="is_refunded">Apakah Terdapat Refund</label>
                                            <select name="is_refunded" class="form-control">
                                                <option value="{{ $accomodation->room->first()?->is_refunded }}">{{ $accomodation->room->first()?->is_refunded == 1 ? 'Ya' : 'Tidak' }}</option>
                                                <option value="1">Ya</option>
                                                <option value="">Tidak</option>
                                            </select>
                                        </div>
                                        @include('admin.booking.rooms.section1-edit')
                                    </div>
                                    <div class="mt-3">
                                         <a class="button btn-navigate-form-step" href="{{ route('rooms.index') }}" >Cancel</a>
                                        <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                                    </div>
                                </section>
                                
                                <section id="step-2" class="form-step d-none">
                                    <h2 class="font-normal">Foto Kamar</h2>
                                    <!-- Step 2 input fields -->
                                    <div class="mt-3">
                                       <input type="file" name="room_image[]" multiple/>
                                        <p class="help-block">{{ $errors->first('room_image.*') }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <div class="mt-3">
                                            <button class="button btn-navigate-form-step" type="button" step_number="1">Sebelumnya</button>
                                            <button class="button submit-btn" type="submit">Simpan</button>
                                        </div>
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

@endsection();

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

    $('#discount_type').change(function(){

        const disc = $('#discount-container');
        const val = $(this).val();
        let text = 'Dalam Rupiah';

        if(val != ''){

            if(val == 'persen'){
                text = 'Dalam Persen'
            }

            disc.html(`
                <div class="form-group">
                    <label for="price">Jumlah Diskon (${text})</label>
                    <input name="discount_amount" type="number" class="form-control form-control-lg">
                </div>
            `);

        } else {
            disc.html(``);
            $('.discount_amount').empty()
        }

        
    })
</script>

@endsection