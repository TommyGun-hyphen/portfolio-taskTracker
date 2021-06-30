@extends('layouts.app')

@section('title', $project->title)

@section('content')
<div class="container border rounded mt-5 p-3">
    <div class="d-flex justify-content-md-between flex-column flex-md-row bg-white p-3 border rounded mx-5">
        <span class="d-flex"><a href="{{($project->user_id == auth()->user()['id'] ? '/project' : '/user/'.$project->user_id)}}" class="btn btn-dark"><</a><h3 class="mx-2">{{$project->title}}</h3></span>
        @if(request()->input()['access'] == "O")
        <a href="/project/{{$project->id}}-{{Str::slug($project->title)}}/edit" class="btn btn-dark">Edit <i class="far fa-edit"></i></a>
        <a href="/project/{{$project->id}}-{{Str::slug($project->title)}}/share" class="btn btn-secondary">share with friends</a>
        @endif

        @if(request()->input()['access'] == "O" || request()->input()['access'] == "S")
        <a href="/project/{{$project->id}}-{{Str::slug($project->title)}}/task/create" class="btn btn-primary">Add a new task</a>
        @endif
        
    </div>
    <div class="row justify-content-center">
        @forelse ($tasks as $task)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 my-1 my-md-3">
                <div class="card h-100" style="background: {{$task->color}};">
                    <div class="card-title border-bottom mx-md-3">
                        <h4 class="bg-white rounded my-3" style="text-decoration: {{($task->is_completed ? 'line-through' : 'none')}}">{{$task->title}}
                            @if (request()->input()['access'] == "O" ||request()->input()['access'] == "S")
                                <a href="/project/{{$project->id}}-{{Str::slug($project->title)}}/task/{{$task->id}}-{{Str::slug($task->title)}}/edit" class="float-right link-unstyled link-hover"><i class="far fa-edit"></i></a>     
                            @endif
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="bg-white rounded p-2p"style="text-decoration: {{($task->is_completed ? 'line-through' : 'none')}}">{{$task->description}}</p>
                        
                    </div>
                    <div class="d-flex">
                        @if(request()->input()['access'] == "O")
                        <form action="/project/{{$project->id}}-{{Str::slug($project->title)}}/task/{{$task->id}}-{{Str::slug($task->title)}}" method="post" class="w-100">
                            @method("delete")
                            @csrf
                            <button class="btn btn-dark float-left" style="font-size: 2ch"><i class="fas fa-times"></i></button>
                        </form>
                        @endif

                        @if(request()->input()['access'] == "O" || request()->input()['access'] == "S")
                        <form action="/project/{{$project->id}}-{{Str::slug($project->title)}}/task/{{$task->id}}-{{Str::slug($task->title)}}" method="POST" class="w-100">
                            @method("patch")
                            @csrf
                            <input type="hidden" name="is_completed" value="{{($task->is_completed ? "false" : "true")}}">
                            <button class="btn btn-dark rounded float-right m-0" style="font-size: 2ch"><i class="{{($task->is_completed ? 'fas fa-check-square' : 'far fa-check-square')}}"></i></button>
                        </form>
                        @endif
                    </div>
                </div>

            </div>
        @empty
            <h3>this project has no tasks yet</h3>
        @endforelse

    </div>

</div>

@endsection