<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $fillable = ['title','img_url','type','episode','members','genre'];
}
