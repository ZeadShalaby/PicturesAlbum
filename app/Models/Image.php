<?php

namespace App\Models;

use App\Models\Album;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'album_id',
        'name',
        'path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'updated_at',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class , 'album_id');
    }

    public function pictures()
    {
        return $this->hasMany(Image::class , "album_id");
    }

    // todo delete all image but still album
    public function deleteall($targetimageId , $albumid)
    {
        if (!$targetimageId) {
            return false;
        }            // Handle the case when the target album does not exist

        $this->pictures()->delete(['album_id' => $albumid]);
        return true;
    }
}
