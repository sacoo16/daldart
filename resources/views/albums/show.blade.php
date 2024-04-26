@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Show Album | {{ $album->name }}
        </div>

        <div class="card-body">
            <div class="form-group  py-2">
                <a class="btn btn-secondary" href="{{ route('albums.index') }}">
                    Back To List
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $album->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $album->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Pictures
                        </th>
                        <td>
                            <div class="form-group row">
                                @foreach ($album->pictures as $picture)
                                    <div class="col-md-2">
                                        <a href="{{ $picture->picture->getUrl() }}" target="_blank">
                                            <img src="{{ $picture->picture->getUrl() }}" alt="{{ $picture->name }}" height="50" width="50">
                                            <strong>{{ $picture->name }}</strong>
                                        </a>

                                        <form action="{{ route('pictures.destroy', [$picture->id]) }}" method="POST"
                                            onsubmit="return confirm('Are you sure ?');" class="block">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-danger btn-sm my-2">
                                                <i class="fas fa-trash"></i> &nbsp; Delete
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('albums.index') }}">
                    Back To List
                </a>
            </div>
        </div>
    </div>
@endsection
