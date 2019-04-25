<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
   	protected $table = 'favorites';
    protected $fillable = ['user_id','anime_id','created_at','updated_at'];
    protected $primaryKey = 'id';

}
