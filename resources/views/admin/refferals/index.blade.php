
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Daftar Refferal</h4>
               {{--  <a href="" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Refferal</a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                        <table id="mytable" class="table-striped text-center" style="width: 100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Affiliator</th>
                            <th>Kode</th>
                            <th>Follower</th>
                            <th>Waktu Tukar</th>
                            <th>Device ID</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                            @forelse($refferals as $key => $refferal)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>{{ $refferal->user?->name }}</td>
                                <td>{{ $refferal->refferal_code }}</td>
                                <td>
                                    @foreach($refferal->followers as $follower)
                                        {{ $follower->user?->name }} <br>
                                    @endforeach
                                    
                                    
                                </td>
                                <td>
                                    {{ $refferal->created_at->format('d-m-Y H:i:s') }}
                                </td>
                                <td>
                                    {{ $refferal->device_id }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.refferals.show', $refferal->id) }}" class="btn btn-primary">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@push('scripts')
<script>
    $("#edit").on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        var name = $(e.relatedTarget).data('name');
        var description = $(e.relatedTarget).data('description');
        $('#edit').find('input[name="id"]').val(id);
        $('#edit').find('input[name="name"]').val(name);
        $('#edit').find('input[name="description"]').val(description);
    });
    
    $('#delete').on('show.bs.modal', (e) => {
        var id = $(e.relatedTarget).data('id');
        console.log(id);
        $('#delete').find('input[name="id"]').val(id);
    });

    $('#mytable').DataTable({
            order : false
        });
</script>
@endpush