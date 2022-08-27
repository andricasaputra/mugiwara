@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    <a href="{{ route('admin.payments_methods.create') }}" class="btn btn-success">Tambah Data</a>
                    <hr>
                    <div class="table-responsive">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Setting Metode Pembayaran</p>
                                <div class="row">
                                  <div class="col-12">
                                    <table id="mytable" class="display expandable-table text-left" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Tipe</th>
                                                <th>Cara</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($methods as $method)
                                                <tr>

                                                    <td>{{ $method->name }}</td>

                                                   <td>{{ $method->type }}</td>


                                                    <td>{!! $method->method !!}</td>
                                                    
                                                    <td class="text-center">
                                                    	<a href="{{ route('admin.payments_methods.edit', $method->id) }}" class="btn btn-success mb-2">Edit</a>

                                                       <form action="{{ route('admin.payments_methods.destroy', $method->id) }}" method="post">
                                                           @csrf
                                                           @method('DELETE')

                                                           <button type="submit" class="btn btn-danger">Hapus</button>
                                                       </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">No settings available</td> 
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