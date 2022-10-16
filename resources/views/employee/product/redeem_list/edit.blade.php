
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Upload Bukti</h4>
            <div class="card-body">
                <form id="fileUploadForm" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <input type="hidden" name="redeem_type" value="{{ $redeem->redeem_type }}">
                    @if($redeem->redeem_type == 'pickup')

                        <label for="photo_pickup">Status</label>
                       <select name="status" class="form-control">
                            <option value="">Belum diambil</option>
                            <option value="1">Sudah diambil</option>
                       </select>

                         <label for="photo_pickup">Foto Pengambilan Ditempat</label>
                         <div>
                            <img src="{{ url('storage/products/pickups/' . $redeem?->image?->image) }}" alt="" width="100">
                        </div>
                        <input type="file" name="photo_pickup" class="form-control">

                    @else

                        <label for="jenis_pengiriman">Jenis Pengiriman</label>
                        <input type="text" name="jenis_pengiriman" class="form-control" required value="{{ $redeem->jenis_pengiriman }}">

                        <label for="no_resi">Nomor Resi</label>
                        <input type="text" name="no_resi" class="form-control" required value="{{ $redeem->no_resi }}">

                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="" {{ $redeem->status == null ? '' : 'selected' }}>Belum dikirim</option>
                            <option value="1" {{ $redeem->status == 1 ? 'selected' : '' }}>Sudah dikirim</option>
                        </select>

                        <label for="photo_deliveryd">Foto Resi</label>
                        <div>
                            <img src="{{ url('storage/products/deliverys/' . $redeem?->image?->image) }}" alt="" width="100">
                        </div>
                        <input type="file" name="photo_delivery" class="form-control" >
                    @endif

                    <div class="d-flex justify-content-center">

                        <a href="{{ route('employee.product.redeem.list') }}" class="btn btn-sm btn-danger mt-3 mr-3">Kembali</a>

                        <button type="submit" class="btn btn-sm btn-primary mt-3">Submit</button>
                        
                    </div>

                    
                </form>
               
                
            </div>
        </div>
    </div>
</div>
@push('scripts')
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
 <script>
        $(function () {

            $(document).ready(function () {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                });

                $('#fileUploadForm').submit(function(e){

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type:'POST',
                        url: "{{ route('employee.product.redeem.list.update', $redeem->id) }}",
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: (res) => {
                          if (res.success) {
                              this.reset();
                              Swal.fire({
                                  icon: res.success ? 'success' : 'error',
                                  title:  res.success ? 'Sukses' : 'Error',
                                  text: res.message,
                                  showConfirmButton: false,
                                  footer: '<a class="btn btn-primary" href="{{ route('employee.product.redeem.list') }}">Kembali</a>'
                                })
                          }
                        },
                        error: function(err){
                          console.log(err)
                        },
                        beforeSend: function () {
                            let timerInterval
                            Swal.fire({
                              title: 'Loading...',
                              timerProgressBar: true,
                               didOpen: () => {
                                Swal.showLoading()
                              },
                              willClose: () => {
                                clearInterval(timerInterval)
                            }
                        });
                    }
                });

                });
            });
        });
    </script>
@endpush

