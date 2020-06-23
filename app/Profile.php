<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['title','description','url','image'];


    //too many way to set default :/ better use with created event may be
    //yes should set from boot method there is a null in database
    public function ProfileImage(){

        $imagePath = ($this->image) ? ('/storage/'.$this->image) : '/image/noImage.png';

        return $imagePath;

    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    //check how many user is followed to this profile noiceee
    public function follower(){
        return $this->belongsToMany('App\User');
    }
}
