@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">
                        <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                @include('inc.message')
                                <p class="card-title">Reviews</p>
                                <div class="row">
                                  <div class="col-12">
                                   {{--  <table id="mytable" class="display expandable-table text-center" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Link</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($reviews as $review)
                                        
                                                <tr>

                                                    <td>{{ $review->name }}</td>

                                                     <td>{{ $review->description }}</td>


                                                      <td>{{ $review->url }}</td>

                                                    <td>
                                                    	<a href="{{ route('admin.appstores.edit', $review->id) }}" class="btn btn-success mb-2">Edit</a>

                                                        <form action="{{ route('admin.appstores.destroy', $review->id) }}" method="post">
                                                        	@csrf
                                                        	@method('DELETE')

                                                        	<button class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4">No settings available</td> 
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table> --}}


                                    @foreach($reviews as $review)

                                        <div class="card">
                                          <div class="card-body">
                                            <div class="card-header d-flex justify-content-end">
                                                <a href="{{ route('rooms.reviews.edit', [$accomodation->id, $review->id]) }}">Edit</a>
                                            </div>
                                            <h6 class="card-title">
                                                <img src="{{ url('storage/avatars/' . $review->user?->account?->avatar) }}" alt="avatar" style="border-radius: 50%"  width="50">
                                                {{ ucwords($review->user?->name) }}
                                            </h6>
                                            <p class="card-text">{{ $review->comment }}</p>
                                            <div class="d-flex justify-content-between align-items-center">

                                                <div>
                                                    @for($i = 0; $i < $review->rating; $i++)
                                                        <img src="{{ url('storage/misc/star_2.png') }}" alt="star" width="15">
                                                    @endfor
                                                </div>

                                                <span>{{ $review->created_at->diffForHumans() }}</span>
                                            </div>
                                          </div>
                                        </div>

                                    @endforeach
                                    
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <a href="{{ route('rooms.index') }}" class="btn btn-danger">Kembali</a>
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