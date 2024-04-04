<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Models\Album;
use App\Models\Image;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Traits\Requests\TestAuth;
use App\Http\Controllers\Controller;
use App\Traits\validator\ValidatorTrait;
use Illuminate\Support\Facades\Redirect;

class ImagesController extends Controller
{
    use TestAuth , ResponseTrait ,ValidatorTrait ,ImageTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $images = Image::where("album_id",$request->id)->with("album")->get(); 
        return view('image.index',['images'=>$images,"album"=>$request->id]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
        return view('image.create')->with('items', $request->id);;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            
        //? Save image (Departments) in folder 
        $folder = 'images/albums';
        $path = $this->saveimage($request->path, $folder);
        $image = Image::create([
            'name'     => $request->name,
            'album_id' => $request->album_id,
            'path'     => $path
        ]);
    
        // Redirect to the index route with a success message
        return Redirect::route('album.index', $request->album_id)->with('status', 'Updated Successfully');

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
    public function edit(Image $image)
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
    public function destroy(Request $request , Image $image)
    {
        if (!$image) {
            return response()->json(['error' => 'image not found'], 404);                  //? Handle the case when the album does not exist
        }

        $image->delete();                                                                  //? Now, delete the album
        return redirect()->back()->with('status', 'delete Successfully');

    }

    //todo autocompleteSearch it work but not in view
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
