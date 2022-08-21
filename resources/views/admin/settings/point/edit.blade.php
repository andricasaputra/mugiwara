
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Setting Point</h4>
            <form action="{{ route('admin.settings.point.update', $setting->id) }}" method="post">
                @csrf
                @method('PUT')

                 <div class="form-group">
                    <input type="hidden" class="form-control" name="type" value="{{ $setting->type }}" required readonly>
                </div>

                <div class="form-group">
                    <label for="name">Kegunaan Point</label>
                    <select name="name" class="form-control">
                    	<option value="{{ $setting->name }}">{{ $setting->name == 'point_refferral' ? 'Point Kode Refferral' : 
                    	'Point Menginap' }}</option>
                        <option value="point_refferral">Point Kode Refferral</option>
                        <option value="point_menginap">Point Menginap</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Tipe Poin</label>
                    <select name="point_type" class="form-control">
                        <option value="{{ $setting->point_type }}">{{ $setting->point_type }}</option>
                        <option value="flat">Flat</option>
                        <option value="percent">Percent</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Jumlah Point</label>
                    <input type="number" class="form-control"  name="value" required value="{{ $setting->value }}">
                </div>

                <div class="form-group">
                    <label for="name">Status</label>
                   <select name="is_active" class="form-control">
                   		<option value="{{ $setting->is_active }}">{{ $setting->is_active == 1 ? 'Aktif' : 'Non Aktif' }}</option>
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


