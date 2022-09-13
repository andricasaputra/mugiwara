
@extends('layouts.main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Syarat</h4>
            <form action="{{ route('admin.syarat.store.syarat') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="keterangan">keterangan</label>
                            <input type="text" class="form-control" name="keterangan">
                        </div>
                    </div>

                    <div class="container-fluid">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

