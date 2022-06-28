@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <h4><i class='fa fa-gear'></i> Edit data kantor</h4>
                    <hr>
                    <form  method="post" action="{{ route('offices.update', $office->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Kantor</label>
                            <input name="name" type="text" class="form-control form-control-lg" value="{{ $office->name }}" required>
                        </div>

                        <div class="form-group">
                            <label for="type">Tipe Kantor</label>
                            <select name="type" id="" class="form-control" required>
                                <option value="{{ $office->type }}">value="{{ $office->type }}"</option>
                                <option value="main_office">Kantor utama</option>
                                <option value="sub_office">Kantor cabang</option>
                              
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="address">Alamat Kantor</label>
                            <textarea name="address" cols="30" rows="3" class="form-control" required>{{ $office->address }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="mobile_number">No HP</label>
                            <input name="mobile_number" class="form-control form-control-lg" value="{{ $office->mobile_number }}" required>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Nama Karyawan</label>
                            <select name="user_id" id="" class="form-control">
                                <option value="{{ $office->user->user_id }}">{{ $office->user->name }}</option>
                                @foreach($employees as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="hotel_id">Nama Hotel</label>
                            <select name="hotel_id" id="" class="form-control">
                                <option value="{{ $office->hotel->hotel_id }}">{{ $office->hotel->name }}</option>
                                @forelse($hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }}</option>
                                @empty
                                    <option value="">-</option>
                                @endforelse
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('offices.index') }}" class="btn btn-danger">Kembali</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()