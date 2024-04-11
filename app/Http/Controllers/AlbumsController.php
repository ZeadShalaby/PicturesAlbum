<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Models\Album;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Traits\Requests\TestAuth;
use App\Http\Controllers\Controller;
use App\Traits\validator\ValidatorTrait;
use Illuminate\Support\Facades\Redirect;

class AlbumsController extends Controller
{
    use TestAuth , ResponseTrait ,ValidatorTrait;
    /**
     * todo Display a listing of the resource.
     */
    public function index()
    {
        //
        $albums = Album::with('user')->get();
        $albums->map(function ($album) {
            $album->fullname = $album->user->firstname.$album->user->lastname;
            return $album;
        });
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
        $rules = $this->rulesAlbum();
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code,$validator);
        }
 
         Album::create([
            'name' => $request->name,
            'user_id' =>2 //auth()->user()->id
             ]);
        return Redirect::route('albums.index')->with('status', 'Create Successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
        $album->load('user');
        return view("album.show",["item"=>$album]);
    }

    /**
     * todo Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
        
        $album->load('user');
        return view('album.edit',['album' => $album]);
    }

    /**
     * todo Update the specified resource in storage.
     */
    public function update( Request $request , Album $album)
    {
        //! validate
        $rules = $this->rulesUpdateAlbum();
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code,$validator);
        }
        $album->update([
            'name' => $request->name,
             ]);
        return Redirect::route("albums.show", $album->id)->with('status', 'Updated Successfully');

    }

     /**
     * todo Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $albumId = $request->input('id');
        $album = Album::find($albumId);

        if (!$album) {
            return response()->json(['error' => 'Album not found'], 404);
        }

        if ($request->has('targetAlbumId')) {
            $targetAlbumId = $request->input('targetAlbumId');
            //todo Move pictures to the target album before deletion
            $targetAlbumIds = Album::latest()->first()->id;
            $album->movePicturesToAlbum($targetAlbumIds);
        }

        //todo Delete pictures associated with the album
        $album->pictures()->delete();

        //todo Delete the album
        $album->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Album deleted successfully',
            'id' => $albumId,
        ]);
    }

    //todo autocompleteSearch it work but not in view
    public function autocompleteSearch(Request $request)
    {

          //!validate
          $rules = $this->rulesAlbumSearch();
          $validator = $this->validate($request,$rules);
          if($validator !== true){return $validator;}

          $query = $request->get('query');
          $filterResult = Album::where('name', 'LIKE', '%'. $query. '%')->with('user')->get();
          return response()->json($filterResult);
    } 
}
