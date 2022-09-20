@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title">Mitra Registran</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="myTable" class="table table-hover display expandable-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>No. Handphone</th>
                            <th>NIK</th>
                            <th>Alamat Usaha</th>
                            <th>Alamat Tinggal</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @if(count($mitraRegistran) != 0)
                    <tbody>
                        @php($counter=1)
                        @forelse($mitraRegistran as $k => $m)
                        <tr>
                            <td>{{$counter++}}</td>
                            <td>{{$m->nama_lengkap}}</td>
                            <td>{{$m->email}}</td>
                            <td>{{$m->hp}}</td>
                            <td>{{$m->nik}}</td>
                            <td>{{$m->alamat_usaha}}</td>
                            <td>{{$m->alamat_tinggal}}</td>
                            <td><a href="{{ asset('file/compro/mitra/submit/'. $m->file) }}">{{$m->file}}</a></td>
                            <td>
                                <a href="{{ route('admin.mitra-registran.compose.mitra-registran', $m->id) }}" class="btn btn-primary btn-sm">Compose</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                    @endif
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#myTable').DataTable({
        order : false
    });
</script>
@endpush