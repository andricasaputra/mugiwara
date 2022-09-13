
@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Menu Compro</h4>
                <a href="{{ route('admin.compro.create.menu') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Menu Compro</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Url</th>
                        <th>Child</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($menu_compros as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no   }}</td>
                            <td> {{ $item->nama_menu }}</td>
                            <td> {{ $item->url_menu }}</td>
                            <td> {{ $item->child_menu }}</td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="{{ route('admin.compro.delete.menu', $item->id) }}">Hapus</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.compro.edit.menu', $item->id) }}">Edit</a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>



@push('scripts')
<script>
    $('#mytable').DataTable({
        oder : false
    });
</script>
@endpush


@endsection

