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
