@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="form-group row">
            <div class="col-md-8 offset-2">
                <div class="card">
                    <div class="card-header">
                        Home
                    </div>
                    <div class="card-body">
                        <h2>Welcome , {{ auth()->user()->name }}</h2>
                        <h5 class="text-center">
                            You can start by <a href="{{ route('albums.index') }}">Albums</a> , then add <a href="{{ route('pictures.index') }}">Pictures</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
