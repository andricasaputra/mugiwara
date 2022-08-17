
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Setting tax</h4>
            <form action="{{ route('admin.settings.tax.store') }}" method="post">
                @csrf

                 <div class="form-group">
                    <input type="hidden" class="form-control" name="type" value="tax" required readonly>
                </div>

                <div class="form-group">
                    <label for="name">Jumlah Pajak (Dalam %)</label>
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

