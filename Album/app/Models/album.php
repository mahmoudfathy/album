<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class album extends Model
{
    use HasFactory;
    protected $table = 'albums';
//    protected $fillable = ['album_name', 'album_iamge'];

    public function GetImages(){

        return $this->hasMany(Image::class, 'album_id');
    }
}
