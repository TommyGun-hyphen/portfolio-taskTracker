@extends('layouts.app')

@section('title', $user->name)

@section('content')
<div class="container border rounded mt-5 p-4">
    @if (auth()->check() == false)
        <button class="btn btn-primary" disabled>Login to send request</button>
    @elseif ($relationship == null)
        <form action="/relationship" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <button class="btn btn-primary">Send request</button>
        </form>
    @elseif ($relationship->type == "R")
    <form action="/relationship/{{$user->id}}" method="post">
        @method('delete')
        @csrf
        <button class="btn btn-secondary">Remove request</button>
    </form>
    @else
    <form action="/relationship/{{$user->id}}" method="post">
        @method('delete')
        @csrf
        <button class="btn btn-danger">Unfriend</button>
    </form>
    @endif
    <h5>Name: <i style="font-size:1rem">{{$user->name}}</i></h5>
    <h5>Email: <i style="font-size:1rem">{{$user->email}}</i></h5>
    <h5>Public projects: <a href="/user/{{$user->id}}/projects/public">all</a></h5>
    <div class="row justify-content-center">
        @forelse ($projects_public as $project)
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
                </div>
            </a>
        </div>
        @empty
            <h3>This user has no public projects.</h3>
        @endforelse
    </div>
    <h5>Shared projects: <a href="/user/{{$user->id}}/projects/shared">all</a></h5>
    <div class="row justify-content-center">
        @forelse ($projects_shared as $project)
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
                </div>
            </a>
        </div>
        @empty
            <h3>This user shared no projects with you.</h3>
        @endforelse
    </div>
</div>


@endsection