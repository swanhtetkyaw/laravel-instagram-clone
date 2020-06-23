<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //this is how u define the event in each model
    protected static function boot(){
        //?? what does it do??
        parent::boot();

        //this is the create event that will trigger when the user is created
        static::created(function($user){
            $user->profile()->create([
                'title' => $user->username,
            ]);
        });
    }

    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    public function posts()
    {
        //dont use short-hand it will get trouble in chaining relation eg.'Post'
        //order by desc so that latest image is showed first
        return $this->hasMany('App\Post')->orderBy('created_at','DESC');
    }

    //keep tracking followed profile with many to many relationShip
    public function following(){
        return $this->belongsToMany('App\Profile');
    }
}
