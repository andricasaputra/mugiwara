
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Berita</h4>
            <form action="{{ route('admin.voucher.update') }}" enctype="multipart/form-data" method="post">
                <input type="hidden" name="id" value="{{ $voucher->id }}">
                @csrf
                @method('PUT')<div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="code">Kode Voucher</label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ $voucher->code }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="name">Nama Voucher</label>
                            <input name="name" id="name" class="form-control" value="{{ $voucher->name }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <input name="description" id="description" class="form-control" value="{{ $voucher->description }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="type">Voucher Dapat Digunakan Untuk</label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="">~ Pilih ~</option>
                                <option value="voucher" {{ $voucher->type == 'voucher' ? 'selected' : '' }}>Voucher</option>
                                <option value="item" {{ $voucher->type == 'item' ? 'selected' : '' }}>Barang</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="max_uses">Maksimal Penggunaan Voucher</label>
                            <input type="number" name="max_uses" id="max_uses" class="form-control" value="{{ $voucher->max_uses }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="max_uses_user">Berapa kali pengguna dapat menggunakan voucher</label>
                            <input type="number" name="max_uses_user" id="max_uses_user" class="form-control" value="{{ $voucher->max_uses_user }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="category">Kategori</label>
                            <select name="category" id="category" class="form-control" required>
                                <option value="">~ Pilih ~</option>
                                <option value="menarik" {{ $voucher->category == 'menarik' ? 'selected' : '' }}>Menarik</option>
                                <option value="rekomendasi" {{ $voucher->category == 'rekomendasi' ? 'selected' : '' }}>Rekomendasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="discount_type">Tipe Diskon</label>
                            <select name="discount_type" id="discount_type" class="form-control" required>
                                <option value="">~ Pilih ~</option>
                                <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Flat</option>
                                <option value="percent" {{ $voucher->discount_type == 'percent' ? 'selected' : '' }}>Persen</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 {{ $voucher->discount_type == 'fixed' ? 'd-none' : '' }}" id="containerPercent">
                        <div class="form-group">
                            <label for="discount_percent">Jumlah Diskon ( % )</label>
                            <input type="number" name="discount_percent" id="discount_percent" class="form-control" value="{{ $voucher->discount_percent }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 {{ $voucher->discount_type == 'percent' ? 'd-none' : '' }}" id="containerFixed">
                        <div class="form-group">
                            <label for="discount_amount">Jumlah Diskon</label>
                            <input type="number" name="discount_amount" id="discount_amount" class="form-control" value="{{ $voucher->discount_amount }}">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="image">Gambar <small>Optional | Isi jika ingin diubah</small></label>
                            <input type="file" class="form-control" name="image" value="{{ $voucher->image }}" id="image">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="starts_at">Voucher Berlaku Pada</label>
                            <input type="datetime-local" class="form-control" name="starts_at" value="{{ $voucher->starts_at }}" id="starts_at" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="expires_at">Voucher Berlaku Sampai</label>
                            <input type="datetime-local" class="form-control" name="expires_at" value="{{ $voucher->expires_at }}" id="expires_at" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="point_needed">Poin Yang Dibutuhkan</label>
                            <input type="number" class="form-control" name="point_needed" value="{{ $voucher->point_needed }}" id="point_needed" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value="">~ Pilih ~</option>
                                <option value="1" {{ $voucher->is_active == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ $voucher->is_active == '0' ? 'selected' : '' }}>Non-Aktif</option>
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

