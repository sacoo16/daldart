@extends('layouts.app')
@section('content')
    <div class="form-group pb-2">
        <a href="{{ route('albums.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Create new album
        </a>
    </div>
    <div class="form-group">
        <div class="card">
            <div class="card-header">
                Albums Table
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Pictures count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($albums as $album)
                            <tr>
                                <td>{{ $album->id }}</td>
                                <td>{{ $album->name }}</td>
                                <td>{{ $album->pictures_count }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <a href="{{ route('albums.add-picture',[$album->id]) }}" class="dropdown-item">
                                                <i class="fa fa-plus"></i>
                                                Add Picture
                                            </a>
                                            <a href="{{ route('albums.show',[$album->id]) }}" class="dropdown-item">
                                                <i class="fa fa-eye"></i>
                                                Show
                                            </a>
                                            <a href="{{ route('albums.edit',[$album->id]) }}" class="dropdown-item">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>

                                            @if ($album->pictures_count > 0)
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteModel(this)" data-id="{{ $album->id }}" class="dropdown-item">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            @else
                                                <form action="{{ route('albums.destroy', $album->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure ?');" class="block">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa fa-trash"></i> &nbsp; Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="4">No Data Available !</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Album</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="post" id="deleteForm">
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <h5 class="text-danger font-weight-bold text-center">
                                This Album has related pictures do you want to delete pictures ?
                            </h5>
                        </div>

                        <div class="form-group">
                            <a href="" class="btn btn-success btn-sm" id="move_link">
                                <i class="fas fa-copy"></i> Move pictures to another album .. 
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function deleteModel(button) 
        {
            let albumId = $(button).data('id');
            let url = "{{ route('albums.destroy', ':id') }}";

            url = url.replace(':id', albumId);
            $('#deleteForm').attr('action', url);

            $('#move_link').click(function(){
                let move_url = "{{ route('albums.to-another-album',':albumId') }}";
                move_url = move_url.replace(':albumId', albumId);
                $('#move_link').attr('href',move_url);
            })
        }
    </script>
@endsection