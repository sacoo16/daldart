@extends('layouts.app')
@section('content')
    <div class="form-group">
        <form action="{{ route('albums.move-pictures-to-another-album',[$album->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="card">
                <div class="card-header">
                    Move Pictures
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="alert alert-warning">
                            <h4 class="text-center">
                                <i class="fa fa-exclamation"></i> After moving pictures to another album .. {{ $album->name }} will be deleted !
                            </h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        @foreach ($album->pictures as $picture)
                            <div class="col-md-2">
                                <a href="{{ $picture->picture->getUrl() }}" target="_blank">
                                    <img src="{{ $picture->picture->getUrl() }}" alt="{{ $picture->name }}" height="50" width="50">
                                    <strong>{{ $picture->name }}</strong>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group row py-3">
                        <div class="col-md-6">
                            <label for="album_id" class="required">To Album</label>
                            <select name="album_id" id="album_id" class="form-control">
                                <option value="{{ null }}">Please Select album</option>
                                @foreach ($albums as $album_id => $album_name)
                                    <option value="{{ $album_id }}" {{ old('album_id',$album->id) == $album_id ? 'selected' : '' }}>{{ $album_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('album_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('album_id') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-check"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection