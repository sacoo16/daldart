@extends('layouts.app')
@section('content')
    <div class="form-group">
        <form action="{{ route('albums.update',[$album->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    Edit Album | {{ $album->name }}
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name" class="required">Name</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Please enter name of album .. Ex: album 1" required value="{{ old('name',$album->name) }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection