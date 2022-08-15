
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tindakan Refund</h4>
            <form action="{{ route('admin.refund.action', $refund->id) }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="refund_number">Kode Refund</label>
                    <input type="text" class="form-control" name="refund_number" value="{{ $refund->refund_number }}" required readonly>
                </div>

                <div class="form-group">
                    <label for="status">Tindakan</label>
                    <select name="status" class="form-control">
                        <option value="tolak">Tolak</option>
                        <option value="setuju">Setuju</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.refund.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection


