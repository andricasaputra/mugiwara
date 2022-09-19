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
            <form action="{{ route('admin.slider-tentang.update.slider-tentang') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $slider->id }}">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" name="name" value="{{$slider->name}}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control" name="description" value="{{$slider->description}}" required>{{$slider->description}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <select name="rating" class="form-control" required>
                                @for($i = 1;$i < 6;$i++)
                                    <option value="{{$i}}" {{$slider->rating == $i ? 'selected' : ''}}>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="customer" {{$slider->role == 'customer' ? 'selected' : ''}}>Customer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="image">Gambar</label>
                            <input type="file" class="form-control" name="image" id="image">
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