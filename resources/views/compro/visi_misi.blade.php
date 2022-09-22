
@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Visi & Misi</h4>
                <a href="{{ route('admin.visiMisi.create.visiMisi') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Slider</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Heading</th>
                        <th>Keterangan</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($visiMisis as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no   }}</td>
                            <td> {{ $item->heading }}</td>
                            <td> {{ $item->keterangan }}</td>
                            <td> {{ $item->kategori }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.visiMisi.edit.visiMisi', $item->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('admin.visiMisi.delete.visiMisi', $item->id) }}">Hapus</a>
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

