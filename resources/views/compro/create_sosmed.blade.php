
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
            <h4 class="card-title">Tambah Sosmed</h4>
            <form action="{{ route('admin.sosmed.store.sosmed') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="link_sosmed">Link</label>
                            <input type="text" class="form-control" name="link_sosmed">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="nama_sosmed">Nama</label>
                            <select class="form-control" name="nama_sosmed" id="" required>
                                <option>Pilih</option>
                                <option value="whatsapp">Whatsapp</option>
                                <option value="twitter">Twitter</option>
                                <option value="facebook">Facebook</option>
                                <option value="instagram">Instagram</option>
                                <option value="youtube">Youtube</option>
                                <option value="tiktok">Tiktok</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="gambar_sosmed">Gambar</label>
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

