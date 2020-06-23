<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $follow = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        return view('profiles.index',compact('user','follow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( User $user)
    {
        $this->authorize('update',$user->profile);

        return view('profiles.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //                                      useful route model binding
    public function update(Request $request,User $user)
    {
       $data = $request->validate([
           'title' => '',
           'description' => '',
           'url' => 'url',
           'image' => ''
       ]);

        if($request->has('image')){
            $imagePath = $request->file('image')->store('profiles','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }else {
            $imagePath = $user->profile->image;
        }
       //only update the data if the auth user is the one who update .....extra protection @@
       if(auth()->user()->id === $user->id){
            $user->profile->update(array_merge(
                $data,
                ['image' => $imagePath]
            ));
       };
       

       return redirect("/profile/$user->id");
       
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
