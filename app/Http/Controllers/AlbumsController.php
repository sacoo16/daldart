<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Requests\Albums\StoreAlbumRequest;
use App\Http\Requests\Albums\UpdateAlbumRequest;
use App\Http\Requests\Pictures\StorePictureRequest;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AlbumsController extends Controller
{
    use MediaUploadingTrait;
    
    public function index()
    {
        $albums = Album::withCount('pictures')->orderby('name')->get();

        return view('albums.index',compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(StoreAlbumRequest $request)
    {
        $albums = Album::create($request->all());

        return redirect()->route('albums.index');
    }

    public function show(Album $album)
    {
        $album->load(['pictures']);

        return view('albums.show',compact('album'));
    }

    public function edit(Album $album)
    {
        $album->load(['pictures']);

        return view('albums.edit',compact('album'));
    }

    public function update(Album $album,UpdateAlbumRequest $request)
    {
        $album->update($request->all());

        return redirect()->route('albums.index');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return back();
    }

    public function add_picture(Album $album)
    {
        $albums = Album::pluck('name','id');

        return view('albums.add-picture',compact('album','albums'));
    }

    public function store_picture(StorePictureRequest $request,Album $album)
    {
        $picture = Picture::create($request->all());

        if ($request->input('picture', false)) {
            $picture->addMedia(storage_path('tmp/uploads/' . basename($request->input('picture'))))->toMediaCollection('pictures');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $picture->id]);
        }

        return redirect()->route('albums.index');
    }

    public function to_another_album(Album $album)
    {
        $album->load(['pictures']);

        $albums = Album::where('id','!=',$album->id)->pluck('name','id');

        return view('albums.move-pictures',compact('album','albums'));
    }

    public function move_to_another_album(Request $request,Album $album)
    {
        $album->load(['pictures']);

        $album->pictures->toQuery()->update([
            'album_id'      => $request['album_id']
        ]);

        $album->delete();

        return redirect()->route('albums.index');
    }
}
