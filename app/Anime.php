<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = ['title','img_url','type','episode','members','genre','created_at','updated_at','gambar','user_id'];
    public $timestamps = false;
    public function favorite()
    {
        return $this->hasMany('App\Favorite');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function ratings(){
        return $this->hasMany('App\Rating');
    }
}
