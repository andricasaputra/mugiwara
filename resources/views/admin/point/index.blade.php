@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <div class="table-responsive">

                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <p class="card-title align-items-center my-auto">Manajemen Poin Pelanggan</p>
                                <hr>
                                <div class="row">
                                  <div class="col-12">
                                    {{-- <div class="table-responsive"> --}}
                                      <table id="user-table" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Deskripsi</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Poin Awal</th>
                                                <th>Poin Akhir</th>
                                                <th>Mutasi</th>
                                                <th>Tipe</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            @foreach ($accountPoints as $accountPoint)
                                            <tr>
                                                <td>{{ ucwords($accountPoint->description) }}</td>

                                                <td>{{ ucwords($accountPoint->user?->name) }}</td>

                                                <td>@currency($accountPoint->before)</td>

                                                <td>@currency($accountPoint->after)</td>
                                                
                                                <td>
                                                    @if($accountPoint->type == 'point_out')
                                                        <span style="color: red; font-weight: bold">
                                                        {{  '-' . $accountPoint->mutation  }}
                                                    </span>
                                                    @else
                                                        <span style="color: green; font-weight: bold">
                                                        {{ '+' . $accountPoint->mutation }}
                                                    @endif
                                                </td>
                                                <td>{{ $accountPoint->type == 'point_in' ? 'Point Masuk' : 'Point Keluar'}}</td>
                                                <td>
                                                    <a href="{{ route('admin.point.show', $accountPoint->id) }}" class="btn btn-sm btn-primary p-2">Detail</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- </div> --}}
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

        $('#user-table').DataTable({
            order : false
        });
    </script>
@endsection()