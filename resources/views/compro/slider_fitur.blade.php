
@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Slider Fitur</h4>
                <a href="{{ route('admin.sliderFitur.create.sliderFitur') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Slider Fitur</a>
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
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no =0;
                        @endphp
                        @foreach ($sliderFiturs as $item)
                        @php
                            $no++;
                        @endphp
                        <tr>
                            <td>{{ $no   }}</td>
                            <td> {{ $item->heading }}</td>
                            <td> {{ $item->keterangan }}</td>
                            <td> <img width="100" src="{{ asset('images/compro/slider_fitur/'. $item->gambar) }}" alt=""></td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.sliderFitur.edit.sliderFitur', $item->id) }}">Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('admin.sliderFitur.delete.sliderFitur', $item->id) }}">Hapus</a>
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

