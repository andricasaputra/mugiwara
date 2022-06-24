@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('offices.create') }}" class="btn btn-success">Tambah Kantor</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Informasi Kantor Induk dan cabang</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama Kantor</th>
                                                <th>Type</th>
                                                <th>Alamat</th>
                                                <th>Nomor HP</th>
                                                <th>Karyawan</th>
                                                <th>Hotel</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($offices as $office)
                                                <tr>
                                                    <td>{{ $office->name }}</td>
                                                    <td>{{ $office->type }}</td>
                                                    <td>{{ $office->address }}</td>
                                                    <td>{{ $office->mobile_number }}</td>
                                                    <td>{{ $office->user->name }}</td>
                                                    <td>{{ $office->hotel->name }}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-between">
                                                            <a class="btn btn-info btn sm" href="{{ route('offices.edit', $office->id) }}">Edit</a>
                                                            <form action="{{ route('offices.delete') }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-small">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Belum ada data untuk ditampilkan</td> 
                                                </tr>
                                            @endforelse
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
        </div>
    </div>
</div>
   
@endsection()

@section('scripts')
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
@endsection()