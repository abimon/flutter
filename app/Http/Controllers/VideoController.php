<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return Video::all();
    }

    public function create()
    {

        $video = request()->file('video');
        $videoPath = $video->store('videos', 'public');

        return response()->json(['message' => 'Video uploaded successfully '.$videoPath]);
        // if ($path != null) {
        //     $video = Video::create([
        //         'userId' => request()->userid,
        //         'path' => $path,
        //         'title' => request()->title,
        //         'category' => request()->category,
        //         'desc' => request()->description,
        //     ]);
        //     return response()->json($video, 200);
        // } else {
        //     return response()->json('Unable to upload file', 408);
        // } 
    }


    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
