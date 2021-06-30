@extends('layouts.app')

@section('title', 'create task')

@section('content')
<div class="container border rounded mt-5 p-4">
    <h3>Add a task to <u>{{$project->title}}</u></h3>
    <form action="/project/{{$project->id}}-{{Str::slug($project->title)}}/task/store" method="post">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{old('title')}}">
            @error('title')
                <small class="text-danger">title is required. it should be at least 5 characters long</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <input type="textarea" name="description" class="form-control" value="{{old('description')}}">
            @error('description')
                <small class="text-danger">description is required. it should be at least 15 characters long</small>
            @enderror
            
        </div>
        <div class="form-group">
            <label for="color">color</label><br>
            <input type="color" name="color" value="{{ ( old('color') != null ? old('color'):'#c2c2c2' ) }}">
        </div>
        <div class="my-3">
            <button class="btn btn-primary">Create task</button>
            <a href="/project/{{$project->id}}-{{Str::slug($project->title)}}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
</div>

@endsection