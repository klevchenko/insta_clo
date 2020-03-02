@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-lg-8 offset-lg-2">
            <div class="card card-default">
                <div class="card-body">

                    <h1 class="card-title">New post</h1>

                    <form action="/p" method="POST" enctype="multipart/form-data" >

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
                            <label for="caption" class="col-12 control-label">Caption</label>

                            <div class="col-12">
                                <textarea id="caption"
                                type="text" 
                                class="form-control" 
                                name="caption">{{ old('caption') }}</textarea>

                                @if ($errors->has('caption'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('caption') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-12 control-label">Image</label>

                            <div class="col-12">
                                <input id="image" 
                                type="file" 
                                class="form-control-file" 
                                name="image" 
                                value="{{ old('image') }}" required autofocus>

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
                                    Post
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
