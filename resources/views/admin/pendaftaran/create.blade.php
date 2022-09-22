@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            <h4 class="card-title">Tambah</h4>
            <form action="{{ route('admin.pendaftaran.store.pendaftaran') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="text">Text</label>
                            <input type="text" class="form-control" name="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="file">File</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection