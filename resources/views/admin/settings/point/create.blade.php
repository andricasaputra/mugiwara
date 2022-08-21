
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Setting Point</h4>
            <form action="{{ route('admin.settings.point.store') }}" method="post">
                @csrf

                 <div class="form-group">
                    <input type="hidden" class="form-control" name="type" value="point" required readonly>
                </div>

                <div class="form-group">
                    <label for="name">Kegunaan Point</label>
                    <select name="name" class="form-control">
                        <option value="point_refferral">Point Kode Refferral</option>
                        <option value="point_menginap">Point Menginap</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Tipe Poin</label>
                    <select name="point_type" class="form-control">
                        <option value="flat">Flat</option>
                        <option value="percent">Percent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Jumlah Point</label>
                    <input type="number" class="form-control"  name="value" required>
                </div>

                <div class="form-group">
                    <label for="name">Status</label>
                   <select name="is_active" class="form-control">
                       <option value="1">Aktif</option>
                       <option value="">Non Aktif</option>
                   </select>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.promotion.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection


