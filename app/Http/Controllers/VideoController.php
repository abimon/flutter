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
        //
    }

    public function create()
    {
        dd(request());
        if (request()->hasFile('video')) {
            $extension = request()->file('video')->getClientOriginalExtension();
            $filenametostore = 'file_' . time() . '.' . $extension;
            $path = request()->file('video')->storeAs('public/profile', $filenametostore);
            if ($path != null) {
                $video = Video::create([
                    'userId' => request()->userid,
                    'path' => $path,
                    'title' => request()->title,
                    'category' => request()->category,
                    'desc' => request()->description,
                ]);
                return response()->json($video, 200);
            } else {
                return response()->json('Unable to upload file', 407);
            }
        } else {
            return response()->json('No file found', 407);
        }
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
