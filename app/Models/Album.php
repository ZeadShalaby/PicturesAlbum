<?php

namespace App\Models;

use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name'
    ];

    
   /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'updated_at',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
    

    public function pictures()
    {
        return $this->hasMany(Image::class , "album_id");
    }

    
    public function movePicturesToAlbum($targetAlbumId)
    {
        $targetAlbum = Album::find($targetAlbumId);
        if (!$targetAlbum) {
            // Handle the case when the target album does not exist
            return false;
        }

        $this->pictures()->update(['album_id' => $targetAlbumId]);
        return true;
    }

}
