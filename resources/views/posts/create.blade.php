@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row">
        <div class="col-8 offset-2">
            <h1>Create New Post</h1>
            <form action="/p" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="caption" class="col-md-4 col-form-label">Add Caption</label>

   
                    <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                    @error('caption')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="image" class="col-md-6 col-form-label">Add Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                        @error('image')
                            <strong>{{ $message }}</strong>
                        @enderror
                      </div>
       
                </div>

                <div class="row pt-3">
                    <button type="submit" class="btn btn-primary">Add Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection