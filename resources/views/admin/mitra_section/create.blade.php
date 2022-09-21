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
                <form action="{{ route('admin.mitra-section.store.mitra-section') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="title">Judul</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="description">Deskripsi</label>
                                <textarea class="form-control" name="description" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="section">Sesi</label>
                                <select name="section" class="form-control" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
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