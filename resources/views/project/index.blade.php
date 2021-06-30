@extends('layouts.app')

@section('title', 'projects')

@section('content')

<div class="container border rounded my-5 p-3">
    <div class="mx-5 bg-white rounded p-3 border">
        <span class="h2 ">My Projects:</span>
        <a href="/project/create" class="btn btn-primary float-right">Create project</a>
    </div>
    <div class="row justify-content-center">
        @forelse ($projects as $project)
        <div class="col-md-3 col-5 m-md-3 m-1">
            <a href="/project/{{$project->id}}-{{Str::slug($project->title)}}" id="link-{{$project->id}}" class="link-unstyled">
                <div class="card rounded" style="background:{{$project->color}};min-height:15em">
                    <div class="card-title border-bottom border-dark mx-3">
                        <h4 class="rounded bg-white my-3">{{$project->title}}
                        </h4>
                    </div>
                    <div class="card-body p-0 mx-3" style="text-align: left">
                        <p class="rounded bg-white my-3 p-2">{{$project->description}}</p>
                    </div>
                    <form action="/project/{{$project->id}}-{{Str::slug($project->title)}}" method="post" class="w-100">
                        @method("delete")
                        @csrf
                        <button class="btn btn-dark float-left" style="font-size: 2ch"><i class="fas fa-times"></i></button>
                    </form>
                </div>
                
            </a>
        </div>
        @empty
            <h3>You do not have any projects yet</h3>
        @endforelse
    </div>


</div>

@endsection