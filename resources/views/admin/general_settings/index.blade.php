@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title">General Settings</h4>
            </div>
            <form action="{{ route('admin.general-settings.store.general-settings') }}" enctype="multipart/form-data" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="app_name">Nama Aplikasi</label>
                                <input type="text" class="form-control" name="app_name" 
                                @if(!is_null($settings))
                                    value="{{$settings->app_name}}"
                                @endif
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="app_version">Versi Aplikasi</label>
                                <input type="text" class="form-control" name="app_version" 
                                @if(!is_null($settings))
                                    value="{{$settings->app_version}}"
                                @endif
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" class="form-control" name="logo" id="logo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="phone_number">No Handphone</label>
                                <input type="text" class="form-control" name="phone_number"
                                @if(!is_null($settings))
                                    value="{{$settings->phone_number}}"
                                @endif
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="address">Alamat</label>
                                <textarea class="form-control" name="address"><?php if(!is_null($settings->address)) echo $settings->address ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email"
                                @if(!is_null($settings))
                                    value="{{$settings->email}}"
                                @endif
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="facebook">Facebook</label>
                                <input type="text" class="form-control" name="facebook"
                                @if(!is_null($settings))
                                    value="{{$settings->facebook}}"
                                @endif
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="instagram">Instagram</label>
                                <input type="text" class="form-control" name="instagram"
                                @if(!is_null($settings))
                                    value="{{$settings->instagram}}"
                                @endif
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="form-group">
                                <label for="twitter">Twitter</label>
                                <input type="text" class="form-control" name="twitter"
                                @if(!is_null($settings))
                                    value="{{$settings->twitter}}"
                                @endif
                                >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <button class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
</script>
@endpush