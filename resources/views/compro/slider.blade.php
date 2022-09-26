
@extends('layouts.main')

@section('content')


<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-header justify-content-between d-flex d-inline">
                <h4 class="card-title align-items-center my-auto">Slider</h4>
                <a href="{{ route('admin.slider.create.slider') }}" class="btn btn-primary btn-sm align-items-center my-auto">Tambah Slider</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                   
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

