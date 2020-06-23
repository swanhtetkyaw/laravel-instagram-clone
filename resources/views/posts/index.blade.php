@extends('layouts.app');

@section('content')
    <div class="container">
        @foreach($posts as $post)
        <div class="row">
            <div class="col-6 offset-3">
                <a href="profile/{{$post->user->id}}">
                    <img src="/storage/{{$post->image}}" class="w-100" alt="">
                </a>  
            </div>
        </div>
        <div class="row mt-2 mb-3">
            <div class="col-6 offset-3">
                <div class="d-flex mb-4 align-items-center">
                    <div style="width: 40px" class="mr-3">
                        <img src="/storage/{{$post->user->profile->image}}" class="rounded-circle w-100" alt="">
                    </div>

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
        @endforeach

        {{-- pagination wtf cool--}}
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{$posts->links()}}
            </div>
        </div>

    </div>
   
@endsection