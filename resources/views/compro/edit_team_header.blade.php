
@extends('layouts.main')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            <h4 class="card-title">Edit Team Header</h4>
            <form action="{{ route('admin.teamHeader.update.teamHeader', $teamHeaders->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="heading" value="{{ $teamHeaders->heading }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="" cols="30" rows="10">{{ $teamHeaders->keterangan }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" class="form-control" name="gambar">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="alt">Alt Gambar</label>
                            <input type="text" class="form-control" name="alt" value="{{ $teamHeaders->alt }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="jabatan">jabatan</label>
                            <input type="text" class="form-control" name="jabatan" value="{{ $teamHeaders->jabatan }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="url_sosmed">URL Sosmed</label>
                            <input type="text" class="form-control" name="url_sosmed" value="{{ $teamHeaders->url_sosmed }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="gambar_sosmed">Gambar Sosmed</label>
                            <input type="file" class="form-control" name="gambar_sosmed">
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
