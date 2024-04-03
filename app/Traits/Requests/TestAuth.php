<?php
namespace App\Traits\Requests;

trait TestAuth
{  


    // todo rules of login for users
    protected function rulesLogin($field){
      if($field == "email"){
      return [
        "field"    => "required|exists:users,email",
        "password" => "required"
    ];}
    else{
      return [
        "field"    => "required|exists:users,username",
        "password" => "required"
    ];
    }
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
    
    // todo rules of store posts 
    protected function rulesAlbum(){
      return [
        'user_id' => 'required|exists:users,id",',
        'name'    => 'required|string|min:4|max:30' 
    ];
    }

    // todo rules of store posts 
    protected function rulesImage(){
      return [
        'album_id' => 'required|exists:albums,id",',
        'name'     => 'required|string|min:4|max:30',
        'file'     => 'required|file|max:30000|mimes:doc,docx,pdf,jpeg,png,jpg',
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