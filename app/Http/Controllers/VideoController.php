<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideoController extends Controller
{
    public function index()
    {
        return Video::all();
    }

    public function create()
    {
        $extension=request()->file('video')->getClientOriginalExtension();
        $filenametostore='video_'.time().'.'.$extension;   
        $path=request()->file('video')->storeAs('public/videos', $filenametostore);
        if ($path != null) {
            $video = Video::create([
                'userId' => request()->userId,
                'path' => $filenametostore,
                'title' => request()->title,
                'category' => request()->category,
                'desc' => request()->desc,

            ]);
            return response()->json($video, 201);
        } else {
            return response()->json('Unable to upload file');
        } 
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
