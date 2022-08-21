
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Tambah Setting Manajemen Menu</h4>
            <form action="{{ route('admin.menus.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control"  name="name" required value="{{ $menu->name }}">
                </div>

                <div class="form-group">
                    <label for="icon">Icon</label>
                    <div>
                        <img src="{{ url('storage/icons/' . $menu->image?->image) }}" alt="menu" width="100">
                    </div>
                    <input type="file" class="form-control"  name="icon_menu">
                </div>

                <div class="form-group">
                    <label for="url">Is Active</label>
                    <select name="is_active" class="form-control">
                        <option value="{{ $menu->is_active }}">{{ $menu->is_active == 1 ?' Aktif' : 'Non aktif' }}</option>
                        <option value="1">Aktif</option>
                        <option value="">Non Aktif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="url">Link</label>
                    <input type="text" class="form-control"  name="url" required value="{{ $menu->url }}">
                </div>

                <div class="form-group">
                    <label for="url">Aktif Untuk Role</label>
                    <select name="role_id[]" class="form-control js-example-tokenizer" multiple>
                        @foreach($menu->role as $role)
                            <option value="{{ $role->role_idid }}" selected="select2">{{ \Spatie\Permission\Models\Role::find($role->role_id)->name }}</option>
                        @endforeach
                        @foreach($roles as $r)
                            <option value="{{ $r->id }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('admin.playstores.index') }}" class="btn btn-light">Kembali</a>
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
        $('.confirm').on('click', function (e) {
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                return true;
            }
            else {
                return false;
            }
        });

        $('#mytable').DataTable();
    </script>

    <script>
    $(document).ready(function() {
        $('#js-example-basic-single').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        $('#js-example-basic-single-regencies').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

        $('#js-example-basic-single-districts').select2();

        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });

    });
</script>
@endsection()


