@extends('layouts.app')
@section('content')
    <div class="form-group pb-2">
        <a href="{{ route('pictures.create') }}" class="btn btn-primary">
            <i class="fa fa-plus"></i> Create new picture
        </a>
    </div>
    <div class="form-group">
        <div class="card">
            <div class="card-header">
                Pictures Table
            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Album</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pictures as $picture)
                            <tr>
                                <td>{{ $picture->id }}</td>
                                <td>
                                    @if ($picture->picture->getUrl())
                                        <a href="{{ $picture->picture->getUrl() }}" target="_blank">
                                            <img src="{{ $picture->picture->getUrl() }}" alt="{{ $picture->name }}" height="50" width="50">
                                        </a>
                                    @else
                                        <span class="badge badge-danger">No Picture founded !</span>
                                    @endif
                                </td>
                                <td>{{ $picture->name }}</td>
                                <td>{{ $picture->album->name ?? '-' }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <a href="{{ route('pictures.show',[$picture->id]) }}" class="dropdown-item">
                                                <i class="fa fa-eye"></i>
                                                Show
                                            </a>
                                            <a href="{{ route('pictures.edit',[$picture->id]) }}" class="dropdown-item">
                                                <i class="fa fa-edit"></i>
                                                Edit
                                            </a>
                                            <form action="{{ route('pictures.destroy', [$picture->id]) }}" method="POST"
                                                onsubmit="return confirm('Are you sure ?');" class="block">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="dropdown-item">
                                                    <i class="fa fa-trash"></i> &nbsp; Delete
                                                </button>
                                            </form>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <td class="text-center" colspan="5">No Data Available !</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection