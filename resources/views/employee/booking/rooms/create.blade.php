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
                                        <div class="label">Detil Informasi Kamar</div>
                                    </a>
                                </li>
                                <!-- Step 2 -->
                                <li class="form-stepper-unfinished text-center form-stepper-list" step="2">
                                    <a class="mx-2">
                                        <span class="form-stepper-circle text-muted">
                                            <span>2</span>
                                        </span>
                                        <div class="label text-muted">Fasilitas</div>
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
                            <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST">

                                <input type="hidden" name="image_type" value="room">
                                <!-- Step 1 Content -->
                                <section id="step-1" class="form-step">
                                    <h3 class="font-normal">Detil Informasi Kamar</h3>
                                    <!-- Step 1 input fields -->
                                    <div class="mt-3">
                                        @include('admin.booking.rooms.section1')
                                    </div>
                                    <div class="mt-3">
                                        <button class="button btn-navigate-form-step" type="button" step_number="2">Next</button>
                                    </div>
                                </section>
                                <!-- Step 2 Content, default hidden on page load. -->
                                <section id="step-2" class="form-step d-none">
                                    <h2 class="font-normal">Fasilitas</h2>
                                    <!-- Step 2 input fields -->
                                    <div class="mt-3">
                                        Step 2 input fields goes here..
                                    </div>
                                    <div class="mt-3">
                                        <button class="button btn-navigate-form-step" type="button" step_number="1">Prev</button>
                                        <button class="button btn-navigate-form-step" type="button" step_number="3">Next</button>
                                    </div>
                                </section>
                                <!-- Step 3 Content, default hidden on page load. -->
                                <section id="step-3" class="form-step d-none">
                                    <h2 class="font-normal">Foto Kamar</h2>
                                    <!-- Step 3 input fields -->
                                    <div class="mt-3">
                                        Step 3 input fields goes here..
                                    </div>
                                    <div class="mt-3">
                                        <button class="button btn-navigate-form-step" type="button" step_number="2">Prev</button>
                                        <button class="button submit-btn" type="submit">Save</button>
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