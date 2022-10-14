
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Voucher</h4>
            <form action="{{ route('admin.voucher.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="code">Kode Voucher</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="name">Nama Voucher</label>
                            <input name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <input name="description" id="description" class="form-control" value="{{ old('description') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="type">Voucher Dapat Digunakan Untuk</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">~ Pilih ~</option>
                                <option value="voucher" {{ old('type') == 'voucher' ? 'selected' : '' }}>Voucher</option>
                                <option value="item" {{ old('type') == 'item' ? 'selected' : '' }}>Barang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="max_uses">Maksimal Penggunaan Voucher</label>
                            <input type="number" name="max_uses" id="max_uses" class="form-control" value="{{ old('max_uses') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="max_uses_user">Berapa kali pengguna dapat menggunakan voucher</label>
                            <input type="number" name="max_uses_user" id="max_uses_user" class="form-control" value="{{ old('max_uses_user') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="">~ Pilih ~</option>
                                <option value="menarik" {{ old('category') == 'menarik' ? 'selected' : '' }}>Menarik</option>
                                <option value="rekomendasi" {{ old('category') == 'rekomendasi' ? 'selected' : '' }}>Rekomendasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="discount_type">Tipe Diskon</label>
                            <select name="discount_type" id="discount_type" class="form-control" required>
                                <option value="">~ Pilih ~</option>
                                <option value="fixed">Flat</option>
                                <option value="percent">Persen</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 d-none" id="containerPercent">
                        <div class="form-group">
                            <label for="discount_percent">Jumlah Diskon ( % )</label>
                            <input type="number" name="discount_percent" id="discount_percent" class="form-control" value="{{ old('discount_percent') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 d-none" id="containerFixed">
                        <div class="form-group">
                            <label for="discount_amount">Jumlah Diskon</label>
                            <input type="number" name="discount_amount" id="discount_amount" class="form-control" value="{{ old('discount_amount') }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" class="form-control" name="image" value="{{ old('image') }}" id="image" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="starts_at">Voucher Berlaku Pada</label>
                            <input type="datetime-local" class="form-control" name="starts_at" value="{{ old('starts_at') }}" id="starts_at" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="expires_at">Voucher Berlaku Sampai</label>
                            <input type="datetime-local" class="form-control" name="expires_at" value="{{ old('expires_at') }}" id="expires_at" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="point_needed">Poin Yang Dibutuhkan</label>
                            <input type="number" class="form-control" name="point_needed" value="{{ old('point_needed') }}" id="point_needed" required>
                        </div>
                    </div>
                     <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="valid_for">Valid Untuk Berapa Malam?</label>
                            <input type="number" class="form-control" name="valid_for" value="{{ old('valid_for') ?? 1 }}" id="valid_for" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="">~ Pilih ~</option>
                                <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="#" style="opacity: 0;">Status</label> <br>
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <a href="{{ route('admin.voucher.index') }}" class="btn btn-light">Kembali</a>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('#discount_type').on('change', function() {
        if($(this).val() == 'fixed'){
            console.log($('#containerPercent').find('input'));
            $('#containerFixed').removeClass('d-none');
            $('#containerPercent').addClass('d-none');
            $('#containerFixed').find('input').prop('required', true);
            $('#containerFixed').find('input').val('');
            $('#containerPercent').find('input').prop('required', false);
        }else{
            $('#containerPercent').removeClass('d-none');
            $('#containerFixed').addClass('d-none');
            $('#containerPercent').find('input').prop('required', true);
            $('#containerPercent').find('input').val('');
            $('#containerFixed').find('input').prop('required', false);
        }
    });
</script>
@endpush

