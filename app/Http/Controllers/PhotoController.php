<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;
use Carbon\Carbon;
use Image;
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


        $originalImage= $request->file('image');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailPath = public_path().'/uploads/thumbnail/';
        $originalPath = public_path().'/uploads/images/';
        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150,150);
        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 

        $imagemodel= new Photo();
        $imagemodel->name = time().$originalImage->getClientOriginalName();
        $imagemodel->image_path = time().$originalImage->getClientOriginalName();
        $imagemodel->save();
        return redirect('photos')->with('status', 'Pic uploaded successfully');
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
        $photo = Photo::find($id);
        return view('photos.edit')->with('photo', $photo);
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
        $photo = Photo::FindOrFail($id);
        $thumbnailPath = public_path().'/uploads/thumbnail/';
        $originalPath = public_path().'/uploads/images/';
        $filename = $photo->image_path;
        File::delete($thumbnailPath.$filename);
        File::delete($originalPath.$filename);

        // update image code
        $originalImage= $request->file('image');
        $thumbnailImage = Image::make($originalImage);
        $thumbnailImage->save($originalPath.time().$originalImage->getClientOriginalName());
        $thumbnailImage->resize(150,150);
        $thumbnailImage->save($thumbnailPath.time().$originalImage->getClientOriginalName()); 
        $photo->name = time().$originalImage->getClientOriginalName();
        $photo->image_path = time().$originalImage->getClientOriginalName();
        $photo->save();
        return redirect('photos')->with('status', 'Pic updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::FindOrFail($id);
        $thumbnailPath = public_path().'/uploads/thumbnail/';
        $originalPath = public_path().'/uploads/images/';
        $filename = $photo->image_path;
        File::delete($thumbnailPath.$filename);
        File::delete($originalPath.$filename);
        $photo->delete();
        return redirect('photos')->with('status', 'Pic deleted successfully');
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
