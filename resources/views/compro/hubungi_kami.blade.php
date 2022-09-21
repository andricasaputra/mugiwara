@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Hubungi Kami</h4>
                {{-- <a href="{{ route('admin.hubungiKami.create.hubungiKami') }}" class="btn btn-primary btn-sm align-items-center my-auto">Hubungi Kami</a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Judul Bantuan</th>
                        <th>Pertanyaan</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($hubungiKamis as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no   }}</td>
                            <td> {{ $item->nama_lengkap }}</td>
                            <td> {{ $item->email }}</td>
                            <td> {{ $item->judul_pertanyaan }}</td>
                            <td> {{ $item->pertanyaan }}</td>
                            <td>
                                <img src="{{ asset('images/compro/hubungi_kami/' . $item->file) }}" width="100">
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="{{ route('admin.hubungiKami.delete.hubungiKami', $item->id) }}">Hapus</a>
                                <!-- <a class="btn btn-primary btn-sm" href="{{ route('admin.hubungiKami.edit.hubungiKami', $item->id) }}">Edit</a> -->
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
