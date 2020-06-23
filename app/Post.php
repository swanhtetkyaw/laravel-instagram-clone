<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['caption','image','user_id'];
    // protected $guarded = [];
    
    public function user(){
        
        return $this->belongsTo('App\User');
    }
}
