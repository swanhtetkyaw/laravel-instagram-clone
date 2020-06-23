<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowsController extends Controller
{
    public function __construct(){
        return $this->middleware('auth');
    }

    public function store(User $user){
    
//(auth user the one who click the follow button)user_id <=> user->profile->id(this user is pass through to the follow controller by clicking the button)
//can only pass id too
        //??JSON??
        return auth()->user()->following()->toggle($user->profile); 
    }
}
