<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Album $album)
    {
        //
        $images = Image::where("album_id",$album)->with("album")->get(); 
        return view('images.index',['images'=>$images]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        //! validate
        $rules = $this->rulesComment();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

        //?save image (Departments) in folder 
        $folder = 'images/albums';
        $path = $this->saveimage($request->path,$folder);
        $image = Image::create([
            'name'     => $request->name,
            'album_id' => $request->album_id,
            'path'     => $path
             ]);
        return Redirect::route('album.index', $album->id)->with('status', 'Updated Successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
        return view('image.show',['images' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * todo Remove the specified resource from storage.
     */
    public function destroy(Image $image , $allphoto)
    {
        //! validate
        $rules = $this->rulesComment();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

        $image = Image::find($image);
        if (!$image) {
            return response()->json(['error' => 'image not found'], 404);                  //? Handle the case when the album does not exist
        }

        $album->deleteall($allphoto , $image->album_id);                                       //? Move pictures to the target album before deleting

        $image->delete();                                                                  //? Now, delete the album
        return "";
    }

    //todo autocompleteSearch
    public function autocompleteSearch(Request $request)
    {
          //!validate
          $rules = $this->rulesComment();
          $validator = $this->validate($request,$rules);
          if($validator !== true){return $validator;}
  
          $query = $request->get('query');
          $filterResult = Image::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    }
}
