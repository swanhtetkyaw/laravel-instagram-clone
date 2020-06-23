@extends('layouts.app');

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{$post->image}}" class="w-100" alt="">
            </div>
            <div class="col-4">
                <div class="d-flex mb-4 align-items-center">
                    <div style="width: 40px" class="mr-3">
                        <img src="/storage/{{$post->user->profile->image}}" class="rounded-circle w-100" alt="">
                    </div>
    
                    <div>
                        <a href="/profile/{{$post->user->id}}" style="text-decoration:none">
                            <h3 class="text-dark">
                                {{$post->user->username}}
                            </h3> 
                        </a>
                    </div>
                    <div class="ml-3">
                        <a href="" style="text-decoration: none">Follow</a>
                    </div>
                </div>
                <div id="caption">
                    
                    <a href="/profile/{{$post->user->id}}" style="text-decoration:none">
                        <span class="text-dark font-weight-bold">
                            {{$post->user->username}}:
                        </span>
                    </a>
                  
                    <span>
                        {{$post->caption}}
                    </span>
                       
                  
                </div>
       
            </div>

        </div>
        
    </div>
   
@endsection