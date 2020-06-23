@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 mt-4 p-4">
            <img src="{{$user->profile->ProfileImage()}}" class="w-100 rounded-circle" alt="profile">
            </div>
            <div class="col-9 p-5 mt-4">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center">
                        <h4>{{$user->username}}</h4>
                        <follow-button user-id={{$user->id}} follow={{$follow}}></follow-button>
                    </div>
                    
                    {{-- have to change later... wrong policy --}}
                    @can('update', $user->profile)
                        <a href="/p/create">Add new Post</a>
                    @endcan
                    
                </div>
                <div class="d-flex mt-4">
                    <div class="mr-5"><strong>{{$user->posts->count()}} </strong>posts</div>
                    <div class="mr-5"><strong>{{$user->profile->follower->count()}} </strong>follower</div>
                    <div class="mr-5"><strong>{{$user->following->count()}} </strong>following</div>
                </div>
                <div class="mt-3 font-weight-bold">{{$user->profile->title}}</div>
                <div class="mt-2">
                    <p>{{$user->profile->description}}</p>
                </div>
            <div class="d-flex justify-content-between align-items-baseline">
                <a href="#">{{$user->profile->url}}</a>
                @can('update', $user->profile)
                    <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
                @endcan
            </div>
            </div>
        </div>

        <div class="row mt-5">
            @foreach ($user->posts as $post)
            <div class="col-4 pb-4">
                <a href="/p/{{$post->id}}">
                    <img src="/storage/{{$post->image}}" class="w-100" alt="">
                </a>
                
            </div>
            @endforeach
        </div>
    </div>
@endsection
