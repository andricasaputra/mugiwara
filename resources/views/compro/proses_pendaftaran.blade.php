
@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto"> Proses Pendaftaran</h4>
                <a href="{{ route('admin.prosesPendaftaran.create.prosesPendaftaran') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Proses Pendaftaran</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Syarat</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($prosesPendaftarans as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no   }}</td>
                            <td> {{ $item->keterangan }}</td>
                            <td>
                                <a class="btn btn-Primary btn-sm" href="{{ route('admin.prosesPendaftaran.edit.prosesPendaftaran', $item->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('admin.prosesPendaftaran.delete.prosesPendaftaran', $item->id) }}">Hapus</a>
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
