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

                            @include('inc.message')
                            <!-- Step Wise Form Content -->
                            <form action="{{ route('accomodations.update', $accomodation->id) }}" method="post">

                            	@method('PUT')
                                <!-- Step 1 Content -->
                                <section id="step-1" class="form-step">
                                    <h3 class="font-normal">Edit Informasi Penginapan</h3>
                                    <!-- Step 1 input fields -->
                                    <div class="mt-3">
                                        @include('admin.booking.accomodations.section1-edit')
                                    </div>
                                    <div class="mt-3">
                                        <a class="button btn-navigate-form-step" href="{{ route('rooms.index') }}" >Cancel</a>
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
</script>





@endsectionedit.blade.php