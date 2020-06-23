<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;

class PostsController extends Controller
{

    //auth middleware
    public function __construct(){
         $this->middleware('auth');
    }

    //index page
    public function index(){
        //get the all posts from the followed profiles
        //first get user_id from followed profiles
        //and query the posts from that user_id
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id',$users)->latest()->paginate(5);

        return view('posts.index',compact('posts'));
    }
    //create form page 
    public function create(){
        return view('posts.create');
    }

    //store input data

    public function store(Request $request){

        // dd(request()->all());
        $data = $request->validate([
            "caption" => 'required',
            "image" => ['required','image']
        ]);
        //upload file into local storage/public/uploads
        //return path of the image
        $imagePath = $request->file('image')->store('uploads','public');

        //resize the image with intervention lib
        //public_path() method return the full path of the public directory
        //?? why curly brace
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();

        //path name of the image and caption are saved 
        //user_id is taken from auth user id @@ cool
        auth()->user()->posts()->create([
            "caption" => $data['caption'],
            "image" => $imagePath
        ]);
        
        //redirect back to the profile page with auth user id 
        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(Post $post){
        return view('posts.show',compact('post'));
    }
}
