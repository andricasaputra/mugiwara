
@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            @if($errors->any())
                {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
            @endif
            <h4 class="card-title">Form Ubah Setting Manajemen Menu</h4>
            <form action="{{ route('admin.menus.update', $menu->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" class="form-control"  name="name" required value="{{ $menu->name }}">
                </div>

                    <hr>

                    <h5>Sub Menu</h5>

                    <hr>

                    <div class="form-group ml-3">
                      <input class="form-check-input" type="checkbox" value="1" id="has_child" {{ count($menu->childs) > 0 ? 'checked' : '' }}>
                          <label class="form-check-label" for="has_child">
                            Apakah mempunyai sub menu?
                          </label>
                    </div>

                    @if(count($menu->childs) > 0)
                        <div class="form-group" id="amount_container">
                             <label for="amount_child">Berapa sub menu?</label>
                            <input type="number" name="amount_child" class="form-control" placeholder="Berapa sub menu?" id="amount_child" value="{{ $menu->amount_child }}">
                        </div>
                    @endif

                    <div class="form-group" id="child_container">

                        @forelse($menu->childs as $key => $child)


                            <label for="submenu">Nama Sub Menu {{ $key + 1 }}</label>
                            <input type="text" name="submenu[]" class="form-control mb-2" value="{{ $child->name }}">

                            <label for="url">Link {{ $key + 1 }}</label>
                            <input type="text" name="url[]" class="form-control" value="{{ $child->url }}">

                            <label for="is_active_child">Aktif / Non aktif {{ $key + 1 }}</label>
                            <select name="is_active_child[]" class="form-control">
                                <option value="{{ $child->is_active }}">{{ $child->is_active == 1 ? 'Aktif' : 'Non Aktif' }}</option>
                                <option value="1">Aktif</option>
                                <option value="">Non Aktif</option>
                            </select>

                        @empty

                            <div class="form-group" id="amount_container"></div>

                            <div class="form-group" id="child_container"></div>

                        @endforelse
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

                @if(count($menu->childs) <= 0)

                <div class="form-group" id="main_url">
                    <label for="url">Link</label>
                    <input type="text" class="form-control"  name="url" required value="{{ $menu->url }}">
                </div>

                @endif

                <div class="form-group" id="main_url_container"></div>

                <div class="form-group">
                    <label for="url">Aktif Untuk Role</label>
                    <select name="role_id[]" class="form-control js-example-tokenizer" multiple>
                        @foreach($menu->role as $role)
                            <option value="{{ $role->role_id }}" selected="select2">{{ \Spatie\Permission\Models\Role::find($role->role_id)?->name }}</option>
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

    let no = 1;
    const child_container = $('#child_container');
    const amount_container = $('#amount_container');
    const main_url = $('#main_url');
    const main_url_container = $('#main_url_container');

    $('#has_child').change(function(){
        let is_checked = $(this).is(':checked');
        
        if(is_checked){
            amount_container.append(`
                <label for="amount_child">Berapa sub menu?</label>
                <input type="number" name="amount_child" class="form-control" placeholder="Berapa sub menu?" id="amount_child">
            `);

            main_url.empty();
            main_url_container.empty();
        } else {
            amount_container.empty()
            child_container.empty()

            main_url_container.html(`
                <label for="url">Link</label>
                <input type="text" class="form-control"  name="url" required>
            `);
        }
    });

    $(document).on('keyup', '#amount_child', function(){

        const val = $(this).val();

        child_container.empty();

        for (var i = 1; i <= val; i++) {
            child_container.append(`
                <label for="submenu">Nama Sub Menu ${i}</label>
                <input type="text" name="submenu[]" class="form-control mb-2" id="submenu${i}">

                <label for="url">Link ${i}</label>
                <input type="text" name="url[]" class="form-control mb-2">

                <label for="is_active_child">Aktif / Non aktif ${i}</label>
                <select name="is_active_child[]" class="form-control mb-2">
                    <option value="1">Aktif</option>
                    <option value="">Non Aktif</option>
                </select>
            `);
        }
    });
    
</script>
@endsection()


