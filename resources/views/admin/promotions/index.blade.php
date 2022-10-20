
@extends('layouts.main')

@section('content')

<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Daftar Promosi</h4>
                <a href="{{ route('admin.promotion.create') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Promosi</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="mytable" class="text-center">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Gambar</th>
                        <th>Masa berlaku</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($promotions as $key => $promotion)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td>{{ $promotion->name }}</td>
                            <td>{{ $promotion->description }}</td>
                            <td>
                                @foreach($promotion->images as $image)
                                    <img src="{{ asset('storage/promotions/' . $image->image) }}" alt="promo" width="200">
                                @endforeach
                            </td>
                            <td>
                                
                                {{ $promotion->start_date }} s/d {{ $promotion->end_date }}

                            </td>
                            <td>{{ $promotion->is_active }}</td>
                            <td>
                                <div class="d-flex flex-column">
                                   <a href="{{ route('admin.promotion.edit', $promotion->id) }}" class="btn btn-warning btn-sm mb-3">Ubah</a>
                                    <form action="{{ route('admin.promotion.destroy', $promotion->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn btn-danger confirm">Delete</button>
                                    </form>
                                </div>
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