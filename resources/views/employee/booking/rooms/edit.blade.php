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
                            <!-- Step Wise Form Content -->
                            @include('inc.message')
                            <form id="userAccountSetupForm" name="userAccountSetupForm" enctype="multipart/form-data" method="POST" action="{{ route('employee.rooms.update', $accomodation?->id) }}">

                                @method('PUT')
                                @csrf

                                <!-- Step 1 Content -->
                                <section id="step-1" class="form-step">
                                    <h3 class="font-normal">Detil Informasi Kamar</h3>
                                    <!-- Step 1 input fields -->
                                    <div class="mt-3">
                                        
                                        @include('employee.booking.rooms.section1-edit')
                                    </div>
                                    <div class="mt-3">
                                         <a class="button btn-navigate-form-step" href="{{ route('employee.rooms.index') }}" >Cancel</a>
                                        <button class="button submit-btn" type="submit">Simpan</button>
                                    </div>
                                </section>
                                
  
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

div.show-image{
    position: relative;
    float:left;
    margin:5px;
    
}

div.show-image:hover{
   opacity: 0.8;
}

div.show-image:hover a{
  display: block;
  opacity: 1;

}

div.show-image a{
  position:absolute;
  top:20;
  left:40;
  display:none;
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

        
    });

    $('.the-buttons').click(function(e){

        e.preventDefault();

        const id = $(this).data('id');

        if (! confirm("yakin ingin hapus foto ini?") == true) {
            return;
         }

        deleteImage(id);

        $('#'+id).remove();
    });

    function deleteImage(id){
        $.ajax({
            url : "{{ route('admin.accomodation.rooms.image.destroy') }}/" + id,
            method: "POST",
            headers : {
                "X-CSRF-TOKEN" : "{{ csrf_token() }}",
                "METHOD" : "DELETE"
            }, success: function(res){
                console.log(res)
            },
            errror: function(err){
                console.log(err)
            }
        })
    }
</script>

@endsection