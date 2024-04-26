<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home',     [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/albums',   App\Http\Controllers\AlbumsController::class);

Route::get('albums/add-picture/{album}', [App\Http\Controllers\AlbumsController::class,'add_picture'])->name('albums.add-picture');
Route::post('albums/store-picture/{album}', [App\Http\Controllers\AlbumsController::class,'store_picture'])->name('albums.store-picture');

Route::get('albums/to-another-album/{album}', [App\Http\Controllers\AlbumsController::class,'to_another_album'])->name('albums.to-another-album');

Route::patch('albums/move-pictures-to-another-album/{album}', [App\Http\Controllers\AlbumsController::class,'move_to_another_album'])->name('albums.move-pictures-to-another-album');

Route::resource('/pictures',  App\Http\Controllers\PicturesController::class);
Route::post('pictures/media', [App\Http\Controllers\PicturesController::class,'storeMedia'])->name('pictures.storeMedia');
