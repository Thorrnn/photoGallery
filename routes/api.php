<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('all-photos', 'Api\PhotoController');
Route::apiResource('/albums', 'Api\AlbumController');
//        Route::get('/photos', 'PhotoController@photoIndex')->name('photos');
Route::post('/photos/upload', 'Api\PhotoController@store')->name('photos.upload');
Route::post('/albums/create', 'Api\AlbumController@store')->name('albums.create');
Route::post('/albums/index', 'Api\AlbumController@index')->name('albums.index');
Route::get('/collages', 'Api\PhotoController@collageIndex')->name('collages');
Route::get('/animatoins', 'Api\PhotoController@animationIndex')->name('animations');

