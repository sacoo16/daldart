<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Requests\Pictures\StorePictureRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Pictures\UpdatePictureRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PicturesController extends Controller
{
    use MediaUploadingTrait;
    
    public function index()
    {
        $pictures = Picture::with(['album'])->latest()->get();

        return view('pictures.index',compact('pictures'));
    }

    public function create()
    {
        $albums = Album::pluck('name','id');

        return view('pictures.create',compact('albums'));
    }

    public function store(StorePictureRequest $request)
    {
        $picture = Picture::create($request->all());

        if ($request->input('picture', false)) {
            $picture->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('pictures');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $picture->id]);
        }

        return redirect()->route('pictures.index');
    }

    public function show(Picture $picture)
    {
        $picture->load(['album']);

        return view('pictures.show',compact('picture'));
    }

    public function edit(Picture $picture)
    {
        $picture->load(['album']);

        $albums = Album::pluck('name','id');

        return view('pictures.edit',compact('picture','albums'));
    }

    public function update(Picture $picture,UpdatePictureRequest $request)
    {
        $picture->update($request->all());

        return redirect()->route('pictures.index');
    }

    public function destroy(Picture $picture)
    {
        $picture->delete();

        return back();
    }
}
