
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
            <h4 class="card-title">Tambah Menu</h4>
            <form action="{{ route('admin.compro.store.menu') }}" method="post">
                @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="nama_menu">Nama</label>
                            <input type="text" class="form-control" name="nama_menu" id="">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="url_menu">Url Menu</label>
                            <input type="text" class="form-control" name="url_menu" id="">
                        </div>
                    </div>

                </form>

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

