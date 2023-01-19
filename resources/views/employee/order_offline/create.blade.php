@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Tambah Pesanan Offline </h4>

                    @include('inc.message')
                    
                    <hr>
                    <form  method="post" action="{{ route('employee.order.offline.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="accomodation_id">Nama Penginapan</label>
                            <select name="accomodation_id" class="form-control">
                                <option value="{{ $accomodation->id }}">{{ $accomodation->name }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="room_id">Nomor Kamar</label>
                            <select name="room_id" id="room_id" class="form-control" required>
                                <option value="0" selected="selected" disabled>Pilih Nomor Kamar</option>
                               @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                               @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="check_in_date">Waktu Check In</label>
                            <input type="date" name="check_in_date" class="form-control form-control-lg" required value="{{ now() }}">
                        </div>

                        <div class="form-group">
                            <label for="stay_day">Lama Menginap</label>
                            <input type="number" name="stay_day" class="form-control form-control-lg" required value="1">
                        </div>

                        <div class="form-group">
                            <label for="total_guest">Jumlah Tamu</label>
                            <input type="total_guest" name="total_guest" class="form-control form-control-lg" required value="">
                        </div>

                        <div class="form-group">
                            <label for="total_guest">Harga Normal Per Malam</label>
                            <input type="number" name="normal_price" id="normal_price" class="form-control form-control-lg" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tax">Pajak (%)</label>
                            <input type="text" name="tax" id="normal_price" class="form-control form-control-lg" readonly value="{{ $tax->value ?? '-' }}">
                        </div>

                        <div class="form-group">
                            <label for="discount_type">Tipe Diskon</label>
                            <input type="text" name="discount_type" id="discount_type" class="form-control form-control-lg" readonly>
                        </div>

                        <div class="form-group">
                            <label for="discount_amount">Diskon</label>
                            <input type="number" name="discount_amount" id="discount_amount" class="form-control form-control-lg" readonly>
                        </div>

                        <div class="form-group">
                            <label for="total_amount">Total Harga</label>
                            <input type="number" name="total_amount" id="total_amount" class="form-control form-control-lg" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('employee.order.offline.index') }}" class="btn btn-danger">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    $(document).ready(function(){

        $('#room_id').on('change', function(){

            $.ajax({
                url : '{{ route('employee.order.offline.room.data') }}',
                method: 'POST',
                headers : {
                    'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                },
                data: { room_id : $(this).val() },
                success: function(res){

                    setForm(res)
                },
                error: function(err){
                    console.log(err);
                }
            });

        });

        function setForm(data)
        {
            let tax = 0;

            if('{{ $tax?->is_active }}' == 1){

                tax = data.price * ('{{ $tax?->value }}' / 100);

            } 
            let normal_price = $('#normal_price');
            let discount_type = $('#discount_type');
            let discount_amount = $('#discount_amount');
            let total_amount = $('#total_amount');

            normal_price.val('');
            discount_type.val('');
            discount_amount.val('');
            total_amount.val('');

            normal_price.val(data.price);
            discount_type.val(data.discount_type);
            discount_amount.val(data.discount_amount);

            if(data.discount_amount != null){

                if(data.discount_type == 'percent'){

                    let discount = data.price * (data.discount_amount / 100);

                    total_amount.val((data.price + tax) - discount);

                }else if(data.discount_type == 'flat'){

                    let total = (data.price + tax) - data.discount_amount;

                    total_amount.val(total);
                }



            } else {

                total_amount.val(data.price + tax);

            }
        }

    });
</script>

@endpush