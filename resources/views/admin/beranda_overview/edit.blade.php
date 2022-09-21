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
                <form action="{{ route('admin.beranda-overview.update.beranda-overview') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $overview->id }}">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="count">Jumlah</label>
                                <input type="number" class="form-control" name="count" value="{{$overview->count}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control" name="description" value="{{$overview->description}}" required>{{$overview->description}}</textarea>
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