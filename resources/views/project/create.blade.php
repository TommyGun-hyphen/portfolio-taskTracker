@extends('layouts.app')

@section('title', 'create a project')

@section('content')
<div class="container border rounded my-5">
<form action="/project/store" method="post">
    @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" value="{{old('title')}}">
        @error('title')
            <small class="text-danger">title is required. it should be at least 5 characters long</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">description:</label>
        <input type="textarea" name="description" class="form-control" value="{{old('description')}}">
        @error('description')
            <small class="text-danger">description is required. it should be at least 15 characters long</small>
        @enderror
        
    </div>
    <div class="form-group">
        <label for="color">color:</label><br>
        <input type="color" name="color" value="{{ ( old('color')!= null ? old('color') : "#c2c2c2" ) }}">
    </div>
    <div class="form-group ">
        <label for="color">visibility:</label><br>
        <div class="inline d-flex">
            <div class="mr-2">
                <label for="">private</label>
                <input type="radio" name="is_public" value="false" {{ ( old('is_public')!="true" ? "checked" : "" ) }}>
            </div>
            <div>
                <label for="">public</label>
                <input type="radio" name="is_public" value="true" {{ ( old('is_public')=="true" ? "checked" : "" ) }}>
            </div>
        </div>
    </div>
    <div class="my-3">
        <button class="btn btn-primary">Create Project</button>
        <a href="/project" class="btn btn-danger">Cancel</a>
    </div>
</form>
</div>

@endsection