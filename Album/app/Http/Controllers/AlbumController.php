<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PharIo\Version\Exception;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list_album = album::all();
        return view('album.index', compact('list_album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('album.create');

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
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if(!empty($validate)) {
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = str::uuid() . $file->getClientOriginalName();
                $file->move(public_path('images/'), $filename);

                $path = 'images/' . $filename;
                $album = new album();
                $album->album_name = $request->name;
                $album->album_img = $path;
                $album->save();
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $album = album::findOrFail($request->id);
        return view('album.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
//        $validate = $request->validate([
//            'name' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
//        ]);
//        if (!empty($validate)) {

            if (!empty($request->hasFile('image'))) {
                $file = $request->file('image');
                $filename = str::uuid() . $file->getClientOriginalName();
                $file->move(public_path('images/'), $filename);
                $path = 'images/' . $filename;
                $album = album::findOrFail($request->id);
                $album->update([
                    $album->album_name = $request->name,
                    $album->album_img = $path
                ]);

            return back();

        }else{
                dd($request->image);
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //

        $image_id = Image::where('album_id', $request->id)->pluck('album_id');
        if ($image_id->count() == 0) {
            album::findOrFail($request->id)->delete();
            return redirect()->route('album.index');

        }else{
            return redirect()->route('album.index');
        }
    }

}
