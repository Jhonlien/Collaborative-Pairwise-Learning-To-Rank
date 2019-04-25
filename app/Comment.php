<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table = 'comments';
    protected $fillable = ['user_id','anime_id','comment','created_at'];
    public $timestamps = true;

     public function anime(){
    	return $this->belongsTo(post::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
