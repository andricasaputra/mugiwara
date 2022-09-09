@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                    @include('layouts.multistepformcss')
                    <div>
                        <div id="multi-step-form-container">

                            <div class="table-responsive">
                                <div class="row">
                                  <div class="col-md-12 grid-margin stretch-card">
                                    <div class="card">
                                      <div class="card-body">
                                        @include('inc.message')
                                        <p class="card-title">Tukar Marchendise</p>
                                        <div class="mb-2">
                                            <a class="btn btn-primary" href="{{ route('tambah_penukaran') }}">Tambah</a>
                                        </div>
                                        <div class="row">
                                          <div class="col-12">
                                            <table id="category_kamar_table" class="display expandable-table table-striped text-center" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>User</th>
                                                        <th>Bukti</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php
                                                        $no = 0;
                                                    @endphp

                                                    @foreach ($penukaranMarchendises as $item)

                                                    @php
                                                        $no++;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $no }}</td>
                                                        <td>{{ $item->user_id }}</td>
                                                        <td>
                                                            <img width="100" src="{{ asset('images/'. $item->bukti_penukaran) }}" alt="">
                                                        <td>

                                                            <a class="btn btn-danger btn-sm" href="{{ route('hapus_penukaran', $item->id) }}">Hapus</a>
                                                            <a class="btn btn-primary btn-sm" href="{{ route('edit_penukaran', $item->id) }}">Edit</a>

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
                              </div>
                            </div>

                        </div>
                    </div>

                    @include('layouts.multistepformjs')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

@section('link')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />

<style>
    .select2-selection__rendered {
    line-height: 15px !important;
    border-radius: 0 !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
    border-radius: 0 !important;
}
.select2-selection__arrow {
    height: 34px !important;
    border-radius: 0 !important;
}
</style>

@endsection

@section('scripts')

<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready( function () {
    $('#category_kamar_table').DataTable();
} );
</script>
@endsection
