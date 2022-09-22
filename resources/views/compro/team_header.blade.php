
@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Team Header</h4>
                <a href="{{ route('admin.teamHeader.create.teamHeader') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Team Header</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Heading</th>
                        <th>Keterangan</th>
                        <th>Gambar</th>
                        <th>Alt Gambar</th>
                        <th>Jabatan</th>
                        <th>Url Sosmed</th>
                        <th>Gambar Sosmed</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($teamHeaders as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no   }}</td>
                            <td> {{ $item->heading }}</td>
                            <td> {{ $item->keterangan }}</td>
                            <td>
                                <img width="100" src="{{ asset('images/compro/team_header/'. $item->gambar) }}" alt="">
                            </td>
                            <td> {{ $item->alt }}</td>
                            <td> {{ $item->jabatan }}</td>
                            <td> {{ $item->url_sosmed }}</td>
                            <td>
                               <img width="100" src="{{ asset('images/compro/team_header/'. $item->gambar_sosmed) }}" alt="">
                            </td>
                            <td>
                                <a class="btn btn-danger btn-sm" href="{{ route('admin.teamHeader.delete.teamHeader', $item->id) }}">Hapus</a>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.teamHeader.edit.teamHeader', $item->id) }}">Edit</a>
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

