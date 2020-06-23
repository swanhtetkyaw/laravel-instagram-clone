<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserResource;

class UserApiController extends Controller
{
    public function index(){
        $user = User::all();
        return UserResource::collection($user);
    }
}
