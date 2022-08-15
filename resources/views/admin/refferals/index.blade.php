
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
                <table id="mytable" class="table table-striped text-center">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Affiliator</th>
                        <th>Referral Code</th>
                        <th>Users</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($refferals as $key => $refferal)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>{{ $refferal->user?->name }}</td>
                            <td>{{ $refferal->user?->account?->refferral_code }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection

@section('link')
    <style>
        td {
          white-space: normal !important; 
          word-wrap: break-word;  
        }
        table {
          table-layout: fixed;
        }

    </style>
@endsection


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

    $('#mytable').DataTable();
</script>
@endpush