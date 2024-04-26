@extends('layouts.app')
@section('content')
    <div class="form-group">
        <form action="{{ route('pictures.update',[$picture->id]) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    Edit Picture | {{ $picture->name }}
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="name" class="required">Name</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Please enter name of album .. Ex: album 1" required value="{{ old('name',$picture->name) }}">
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label for="album_id" class="required">Album</label>
                            <select name="album_id" id="album_id" class="form-control">
                                <option value="{{ null }}">Please Select album</option>
                                @foreach ($albums as $album_id => $album_name)
                                    <option value="{{ $album_id }}" {{ old('album_id',$picture->album_id) == $album_id ? 'selected' : '' }}>{{ $album_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('album_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('album_id') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group py-2">
                        <label for="picture">Picture</label>
                        <div class="needsclick dropzone {{ $errors->has('picture') ? 'is-invalid' : '' }}"
                            id="picture-dropzone">
                        </div>
                        @if ($errors->has('picture'))
                            <div class="invalid-feedback">
                                {{ $errors->first('picture') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        Dropzone.options.pictureDropzone = {
            url: '{{ route('pictures.storeMedia') }}',
            maxFilesize: 5, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 5,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="picture"]').remove()
                $('form').append('<input type="hidden" name="picture" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="picture"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($picture) && $picture->picture)
                    var file = {!! json_encode($picture->picture) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="picture" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection