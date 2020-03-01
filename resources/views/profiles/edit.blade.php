@extends('layouts.app')

@section('content')
<div class="container mb-5">
    <div class="row">
        <div class="col col-lg-8 offset-lg-2">
            <div class="card card-default">
                <div class="card-body">

                    <h1 class="card-title">Edit user {{ $user->name }}</h1>

                    <form action="/profile/{{ $user->id }}" method="POST" enctype="multipart/form-data" >

                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-12 control-label">Title</label>

                            <div class="col-12">
                                <input id="title" 
                                type="text" 
                                class="form-control" 
                                name="title" 
                                value="{{ old('title') ?? $user->profile->title }}" autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-12 control-label">Description</label>

                            <div class="col-12">
                                <textarea id="description" 
                                type="text" 
                                class="form-control" 
                                name="description" 
                            >{{ old('description')  ?? $user->profile->description }}</textarea>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="col-12 control-label">URL</label>

                            <div class="col-12">
                                <input id="url" 
                                type="text" 
                                class="form-control" 
                                name="url" 
                                value="{{ old('url') ?? $user->profile->url }}" autofocus>

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-12 control-label">Profile image</label>

                            <div class="col-12">
                                <input id="image" 
                                type="file" 
                                class="form-control-file" 
                                name="image">

                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-12 mt-5">
                                <button type="submit" class="btn btn-block btn-primary">
                                    Update profile
                                </button>
                            </div>
                        </div>

                    </form>             
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
