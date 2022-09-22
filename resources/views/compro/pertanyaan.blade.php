
@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto"> Pertanyaan</h4>
                <a href="{{ route('admin.pertanyaan.create.pertanyaan') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Pertanyaan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="display expandable-table table-striped text-center" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Pertanyaan</th>
                        <th>Kategori</th>
                        <th>Jawaban</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($pertanyaans as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no   }}</td>
                            <td> {{ $item->keterangan }}</td>
                            <td> {{ $item->kategori }}</td>
                            <td> {!! $item->jawaban !!}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.pertanyaan.edit.pertanyaan', $item->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('admin.pertanyaan.delete.pertanyaan', $item->id) }}">Hapus</a>
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

