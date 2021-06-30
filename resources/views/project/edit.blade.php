@extends('layouts.app')

@section('title', 'edit {{$project->title}}')

@section('content')
<div class="container border rounded my-5">
<form action="/project/{{$project->id}}-{{Str::slug($project->title)}}" method="post">
    @method('patch')
    @csrf
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" value="{{$project->title}}">
        @error('title')
            <small class="text-danger">title is required. it should be at least 5 characters long</small>
        @enderror
    </div>
    <div class="form-group">
        <label for="description">description:</label>
        <input type="textarea" name="description" class="form-control" value="{{$project->description}}">
        @error('description')
            <small class="text-danger">description is required. it should be at least 15 characters long</small>
        @enderror
        
    </div>
    <div class="form-group">
        <label for="color">color:</label><br>
        <input type="color" name="color"  value="{{$project->color}}">
    </div>
    <div class="form-group ">
        <label for="color">visibility:</label><br>
        <div class="inline d-flex">
            <div class="mr-2">
                <label for="">private</label>
                <input type="radio" name="is_public" value="false" {{(!$project->is_public ? "checked" : "")}}>
            </div>
            <div>
                <label for="">public</label>
                <input type="radio" name="is_public" value="true" {{($project->is_public ? "checked" : "")}}>
            </div>
        </div>
    </div>
    <div class="my-3">
        <button class="btn btn-primary">Edit Project</button>
        <a href="/project/{{$project->id}}-{{Str::slug($project->title)}}" class="btn btn-danger">Cancel</a>
    </div>
</form>
</div>

@endsection