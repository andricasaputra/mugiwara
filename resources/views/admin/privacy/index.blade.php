@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('privacy.create') }}" class="btn btn-success">Tambah Kebijakan Privasi</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Kebijakan Privasi</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Judul</th>
                                                <th>Isi</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($policies as $policy)
                                                <tr>
                                                    <td>{{ $policy->title }}</td>
                                                    <td>{!! substr($policy->body,0,100) . '...' !!}</td>
                                                    <td>
                                                        <div class="d-flex justify-content-between">
                                                            <a class="btn btn-info btn sm" href="{{ route('privacy.edit', $policy->id) }}">Edit</a>
                                                            <a target="_blank" class="btn btn-info btn sm" href="{{ route('privacy.show', $policy->id) }}">Detail</a>
                                                            <form action="{{ route('privacy.destroy', $policy->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger btn-small">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3">Belum ada data untuk ditampilkan</td> 
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

	<script src="https://cdn.ckeditor.com/ckeditor5/34.1.0/classic/ckeditor.js"></script>

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

