
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
            <h4 class="card-title">Edit Visi dan Misi</h4>
            <form action="{{ route('admin.visiMisi.update.visiMisi', $visiMisis->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="heading">Heading</label>
                            <input type="text" class="form-control" name="heading" value="{{ $visiMisis->heading }}">
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control" name="keterangan" id="" cols="30" rows="10">{{ $visiMisis->keterangan }}</textarea>
                        </div>
                    </div>

                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select class="form-control" name="kategori" required>
                                <option value="">Pilih</option>
                                <option value="visi">Visi</option>
                                <option value="misi">Misi</option>
                            </select>
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
