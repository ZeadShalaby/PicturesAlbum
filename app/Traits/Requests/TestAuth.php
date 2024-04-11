<?php
namespace App\Traits\Requests;

trait TestAuth
{  


    // todo rules of login for users
    protected function rulesLogin($field){
      return [
        'email' => 'required|email',
        'password' => 'required|alphaNum|min:3'
      ];
    }
  
    // todo rules of users registers
    protected function rulesRegist(){
      return [
        "firstname" => "required|min:4|max:20",
        "lastname"  => "required|min:4|max:20",
        "email"     => "required|unique:users,email",
        "password"  => "required|min:8",
        "gender"    => "required"
    ];
    }
    
    // todo rules of store Album 
    protected function rulesAlbum(){
      return [
        'name'    => 'required|string|min:1|max:30' 
    ];
    }

    // todo rules of Update Album 
    protected function rulesUpdateAlbum(){
      return [
        'name'    => 'required|string|min:4|max:30' 
    ];
    }

    // todo rules of store posts 
    protected function rulesImage(){
      return [
        'album_id' => 'required|exists:albums,id",',
        'name'     => 'required|string|min:4|max:30',
        'path'     => 'required|file|max:30000|mimes:doc,docx,pdf,jpeg,png,jpg',
    ];
    }

        // todo rules of destroy album 
        protected function rulesalbumdestroy(){
          return [
            'album_id' => 'required|exists:albums,id",',
          ];
        }
     // todo rules of search Album
     protected function rulesAlbumSearch(){
      return [
        'query'     => 'required|string|min:1|max:30',
    ];
    }


  
   // todo rules update users
   protected function rulesUpdateUsers(){
    return  [
        "firstname" => "required|min:4|max:20",
        "lastname"  => "required|min:4|max:20",
        "email"     => "required|unique:users,email",
        "password"  => "required|min:8",
        "gender"    => "required"
  ];
  }



   

}