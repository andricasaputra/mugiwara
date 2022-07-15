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
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Kantor</label>
                            <input name="name" type="text" class="form-control form-control-lg"  required value="{{ $office->name }}">
                        </div>

                        <div class="form-group">
                            <label for="type">Tipe Kantor</label>
                            <select name="type" id="" class="form-control" required>
                                <option value="{{ $office->type }}">{{ $office->type == 'main_office' ? 'Kantor utama' : 'Kantor Cabang' }}</option>
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
                            <input name="mobile_number" class="form-control form-control-lg" required value="{{ $office->mobile_number }}">
                        </div>

                        <div class="form-group">
                            <label for="user_id">Nama Karyawan</label>
                            <select name="user_id" id="" class="form-control">
                                <option value="{{ $office->user?->id }}">{{ $office->user?->name }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="accomodations_id">Nama Hotel</label>
                            <select name="accomodation_id" id="" class="form-control">
                                <option value="{{ $office->accomodation?->id }}">{{ $office->accomodation->name }}</option>
                                @forelse($accomodations as $accomodation)
                                    <option value="{{ $accomodation->id }}">{{ $accomodation->name }}</option>
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