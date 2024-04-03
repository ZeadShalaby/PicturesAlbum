<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumsController extends Controller
{
    /**
     * todo Display a listing of the resource.
     */
    public function index()
    {
        //
        $album = Album::with('user')->get();
        return $album;
        return view('album.index',['albums' => $albums]);

    }

    /**
     * todo Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('album.create');
    }

    /**
     * todo Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //! validate
        $rules = $this->rulesComment();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

        $album = Album::create([
            'name' => $request->name,
            'user_id' => $request->user_id,
             ]);
        return Redirect::route('album.index', $album->id)->with('status', 'Updated Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * todo Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
        return view('album.edit',['albums' => $album]);
    }

    /**
     * todo Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //! validate
        $rules = $this->rulesComment();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

        $album->update([
            'name' => $request->name,
             ]);
        return Redirect::route('album.index', $album->id)->with('status', 'Updated Successfully');

    }

    /**
     * todo Remove the specified resource from storage.
     */
    public function destroy(Album $album , $targetAlbumId )
    {
        //! validate
        $rules = $this->rulesComment();
        $validator = $this->validate($request,$rules);
        if($validator !== true){return $validator;}

        $album = Album::find($album);
        if (!$album) {
            return response()->json(['error' => 'Album not found'], 404);                  //? Handle the case when the album does not exist
        }

        $album->movePicturesToAlbum($targetAlbumId);                                       //? Move pictures to the target album before deleting

        $album->pictures->delete();                                                                  //? Now, delete the album

        // return response()->json(['message' => 'Album deleted successfully']);
       
    }

    //todo autocompleteSearch
    public function autocompleteSearch(Request $request)
    {
          //!validate
          $rules = $this->rulesComment();
          $validator = $this->validate($request,$rules);
          if($validator !== true){return $validator;}
  
          $query = $request->get('query');
          $filterResult = Album::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    } 
}
