<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos= Video::all();
        return $videos;
    }

    public function create($id)
    {

        request()->validate([
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:102400', // 100MB limit, adjust as needed
        ]);
        $extension = request()->file('video')->getClientOriginalExtension();
        $filenametostore = uniqid() . time() . '.' . $extension;
        $videoPath = request()->file('video')->storeAs('public/videos', $filenametostore);
        // $videoPath = request()->file('video')->store('videos', 'public');
        $video = Video::create([
            'userId' => $id,
            'path' => $videoPath,
            'title' => request()->title,
            'category' => request()->category,
            'desc' => request()->description,
        ]);
        return response()->json($video, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
