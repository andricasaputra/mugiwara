create
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Setting Fee</h4>
            <form action="{{ route('admin.settings.fee.update', $fee->id) }}" method="post">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Kantor Cabang</label>
                    <select name="office_id" class="form-control">
                        <option value="{{ $fee->office?->id }}">{{ $fee->office?->name }}</option>
                        @foreach($offices as $office)
                            @if( $office->id != $fee->office?->id )
                                <option value="{{ $office->id }}">{{ $office->name }}</option>
                            @endif
                            
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Jumlah Fee (persen)</label>
                    <input type="number" class="form-control"  name="value" value="{{ $fee->value  }}">
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.settings.fee.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection


