<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\album;

class Image extends Model
{
    use HasFactory;
    protected $fillable = ['image_name', 'image_path','album_id'];

    protected $table = 'images';

//    public function album(){
//
//        return $this->belongsTo(album::class, 'album_id');
//    }
}
