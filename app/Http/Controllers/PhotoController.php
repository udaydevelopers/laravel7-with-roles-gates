<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Mail\Upload;
class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif,jpg|max:2048'
        ]);

        $cover = $request->file('image');
        $extension = $cover->getClientOriginalExtension();
        Storage::disk('public')->put($cover->getClientOriginalName(),  File::get($cover));

        //$filename = $request->file('image')->getClientOriginalName();
        //$imagePath = $image->storeAs("upload/pic", $filename);
       // $path = $request->file('image')->storeAs('uploads/pic', $filename);

        //dd($request->all());
        $photo = new Photo;
        $photo->name = $cover->getClientOriginalName();
        $photo->image_path = $cover->getClientOriginalName();
        $photo->save();
        return redirect('photos')->with('status', 'Pic uploaded successfully');;
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

    public function upload_doc()
    {
        return view('photos.upload_doc');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_form(Request $request)
    {
        $title = $request->file('title');
    
        // Get the uploades file with name document
        $document = $request->file('document');
    
        // Required validation
        $request->validate([
            'title' => 'required|max:255',
            'document' => 'required'
        ]);
    
        // Check if uploaded file size was greater than 
        // maximum allowed file size
        if ($document->getError() == 1) {
            $max_size = $document->getMaxFileSize() / 1024 / 1024;  // Get size in Mb
            $error = 'The document size must be less than ' . $max_size . 'Mb.';
            return redirect()->back()->with('flash_danger', $error);
        }
        
        $data = [
            'document' => $document
        ];
        
        // If upload was successful
        // send the email
        $to_email = "udaydeveloper@gmail.com";
        Mail::to($to_email)->send(new Upload($data));
        return redirect()->back()->with('status', 'Your document has been uploaded.');
    }
}
