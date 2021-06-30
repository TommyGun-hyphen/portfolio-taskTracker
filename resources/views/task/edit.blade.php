@extends('layouts.app')

@section('title', 'edit: '. $project->title." > ". $task->title )

@section('content')
<div class="container border rounded mt-5">
    <h3>Edit Task <u>{{$project->title}} > {{$task->title}}</u></h3>
    <form action="/project/{{$project->id}}-{{Str::slug($project->title)}}/task/{{$task->id}}-{{Str::slug($task->title)}}" method="post">
        @method("patch")
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{$task->title}}">
            @error('title')
                <small class="text-danger">title is required. it should be at least 5 characters long</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">description</label>
            <input type="textarea" name="description" class="form-control" value="{{$task->description}}">
            @error('description')
                <small class="text-danger">description is required. it should be at least 15 characters long</small>
            @enderror
            
        </div>
        <div class="form-group">
            <label for="color">color</label><br>
            <input type="color" name="color" value="{{$task->color}}">
        </div>
        <div class="form-group">
            <label for="color">Completed</label><br>
            <input type="checkbox" name="is_completed" style="width: 3em" 
            value="true"{{ ($task->is_completed ? "checked" : "") }}>
        </div>
        <div class="my-3">
            <button class="btn btn-primary">Edit task</button>
            <a href="/project/{{$project->id}}-{{Str::slug($project->title)}}" class="btn btn-danger">Cancel</a>
        </div>
    </form>
    
</div>

@endsection