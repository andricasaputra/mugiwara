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

@endsection()

@section('link')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />

<style>
    .select2-selection__rendered {
    line-height: 15px !important;
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#js-example-basic-single').select2();

        $('#js-example-basic-single-regencies').select2();

        $('#js-example-basic-single-districts').select2();
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



<script>

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
        }

        
    })
</script>



@endsection