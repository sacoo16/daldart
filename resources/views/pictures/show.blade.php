@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Show Picture | {{ $picture->name }}
        </div>

        <div class="card-body">
            <div class="form-group  py-2">
                <a class="btn btn-secondary" href="{{ route('pictures.index') }}">
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
                            {{ $picture->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $picture->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Album
                        </th>
                        <td>
                            {{ $picture->album->name ?? '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Picture
                        </th>
                        <td>
                            <a href="{{ $picture->picture->getUrl() }}" target="_blank">
                                <img src="{{ $picture->picture->getUrl() }}" alt="{{ $picture->name }}" height="80" width="80">
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-secondary" href="{{ route('pictures.index') }}">
                    Back To List
                </a>
            </div>
        </div>
    </div>
@endsection
