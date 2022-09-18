<?php

namespace App\Http\Controllers;

use App\Models\album;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($albumID)
    {
        $GetOneAlbum = album::where('id',$albumID)->with('GetImages')->first();
//        dd($list_image->GetImages);
$album = album::all();
        return view('image.index', compact('GetOneAlbum', 'album'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if (!empty($validate)) {
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = $file->getClientOriginalName();
                $file->move(public_path('images/'), $filename);
                $path = 'images/' . $filename;
                $image = new Image();
                $image->image_name = $request->name;
                $image->image_path = $path;
                $image->album_id = $request->album;
                $image->save();
            }
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if($request->file('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/'), $filename);
            $path = 'images/'.$filename;
            $image = Image::findOrFail($request->id);
            $image->update([
                $image->image_name = $request->name,
                $image->image_path = $path,
                $image->album_id   = $request->album,
            ]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Image::findOrFail($request->id)->delete();
        return back();
    }
    public function delete_all(Request $request){
        try {
            $delete_all_id = explode(',', $request->delete_all_id);
            Image::whereIn('id', $delete_all_id)->delete();
            return back();
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
