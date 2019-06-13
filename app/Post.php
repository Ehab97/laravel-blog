<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class post extends Model{

    protected $fillable=['title','content'];

    public function likes(){
    	return $this->hasMany('App\Like','post_id');
    }
     public function tags(){
    	return $this->belongsToMany('App\Tag','post_tag','post_id','tag_id')->withTimestamps();
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function setTitleAttribute($value){
    	$this->attributes['title']=strtolower($value);
    }
     public function getTitleAttribute($value){
     	return strtoupper($value);
     }

}