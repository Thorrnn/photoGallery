<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PhotoRequest;
use App\Models\Dashboard\Photo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
//        dd(Photo::all());
        return Photo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PhotoRequest $request)
    {
//        dd('ДАДОВА!');
////        dd($request->allFiles('photo'));
        if($request->hasFile('photo')) {
//            dd('ЕСТЬ ФАЙЛЫ');
            foreach($request->file('photo') as $file) {
//                $file = $file;
                $kindId = $request->all()['kind'] ?? 1;
                $date = Carbon::now()->format('Y_m_d');
                $data = [];

                $data['user_id'] = 1;
                $data['size'] = $file->getSize();
                $data['name'] = $file->getClientOriginalName();
                $data['path'] = $file->store("/images/{$date}", 'public');
                $data['extension'] = $file->getClientOriginalExtension();
                $data['url'] = Storage::url($data['path']);
                $imageSize = getimagesize($file);
                $data['width'] = $imageSize[0];
                $data['height'] = $imageSize[2];
                $data['kind_id'] = $kindId;
//                dd(Photo::all());
                Photo::create($data);
        }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function update(PhotoRequest $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Photo $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }

    public function photoIndex()
    {
        $photos = Photo::where('kind_id', 1)
                    ->with('roles')
                    ->orderBy('created_at', 'desc')
                    ->get();

        return $photos;
    }

    public function collageIndex()
    {
        $collages = Photo::where('kind_id', 2)
            ->with('roles')
            ->orderBy('created_at', 'desc')
            ->get();

        return $collages;
    }

    public function animationIndex()
    {
        $animations = Photo::where('kind_id', 3)
            ->with('roles')
            ->orderBy('created_at', 'desc')
            ->get();

        return $animations;
    }
}
