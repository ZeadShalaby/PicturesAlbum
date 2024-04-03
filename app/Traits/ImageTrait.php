<?php
namespace App\Traits;

use App\Models\Comment;
use App\Models\Favourite;
use App\Models\SavedPosts;

trait ImageTrait

{ 

   // todo save image 
   public function saveimage($image , $folder)
   {
      $image_name = time().'.'.$image->extension();
      $images = $image->move(public_path($folder),$image_name) ;
      $path = $image_name;
      return $path;
   }

   

}