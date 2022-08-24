
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Kirim Push Notifikasi</h4>
            <form action="{{ route('admin.notifications.push.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input type="text" class="form-control"  name="title" required>
                </div>

                <div class="form-group">
                    <label for="text">Isi</label>
                    <input type="text" class="form-control"  name="text" required>
                </div>


                 <div class="form-group">
                    <label for="url">Penerima</label>
                    <select name="receiver[]" class="form-control js-example-tokenizer" multiple>
                        <option value="all">Semua pelanggan</option>
                        @foreach($users as $user)
                            <option value="{{ $user->device_token }}">{{ ucwords($user->name) }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.notifications.push.index') }}" class="btn btn-light">Kembali</a>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('link')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

    $(document).ready(function() {

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    });

    </script>

@endsection()



