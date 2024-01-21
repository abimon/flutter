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
        Log::channel('upload')->info(request());
        $video = request()->file('video');
        $path = $video->store('videos', 'public');
        // return response()->json(['message' => 'Video uploaded successfully ' . $videoPath]);
        if ($path != null) {
            $video = Video::create([
                // 'userId' => request()->userid,
                'path' => $path,
                // 'title' => request()->title,
                // 'category' => request()->category,
                // 'desc' => request()->description,
                'userId' => 1,
                'title' => 'Tesst title',
                'category' => 'Test',
                'desc' => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laborum, eveniet praesentium cupiditate error vel saepe accusantium est labore quibusdam perferendis debitis neque quod. Ut dolorum ex qui, impedit sint praesentium.",

            ]);
            return response()->json($video, 200);
        } else {
            return response()->json('Unable to upload file', 408);
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
