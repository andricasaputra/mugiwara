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
                                        <div class="label">Detil Informasi Penginapan</div>
                                    </a>
                                </li>
                                <!-- Step 2 -->
                                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                                    <a class="mx-2">
                                        <span class="form-stepper-circle text-muted">
                                            <span>2</span>
                                        </span>
                                        <div class="label text-muted">Informai Detil Kamar</div>
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
                            <!-- Step Wise Form Content -->
                            <form action="{{ route('accomodations.store') }}" method="POST" id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data">

                                <input type="hidden" name="image_type" value="room">
                                <!-- Step 1 Content -->
                                <section id="step-1" class="form-step">
                                    <h3 class="font-normal">Detil Informasi Penginapan</h3>
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
                                        @include('admin.booking.accomodations.section3')
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

@endsection();

@section('link')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">

@endsection

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });

    // Register the plugin with FilePond
    FilePond.registerPlugin(FilePondPluginImagePreview);

    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create the FilePond instance
    const pond = FilePond.create(inputElement);

</script>

@endsection