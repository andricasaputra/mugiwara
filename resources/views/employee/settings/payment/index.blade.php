@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                    {{-- <a href="{{ route('settings.create') }}" class="btn btn-success">Add Role</a> --}}
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
                                    <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($lists as $list)
                                                <tr>

                                                    <td>{{ $list->channel_code }}</td>

                                                    <td>{{ str_replace("_", " ", $list->channel_category) }} </td>


                                                    <td style="font-weight: bold; {{ $list->is_active == 1 ? 'color : green' : 'color : red' }}">{{ $list->is_active == 1 ? 'Aktif' : 'Non Aktif' }} </td>

                                                    <td><img src="{{ $list->image }}" alt="payment" width="100"></td>

                                                    <td>
                                                    	<a href="{{ route('admin.settings.payment.edit', $list->id) }}" class="btn btn-success">Edit</a>
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