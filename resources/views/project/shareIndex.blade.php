@extends('layouts.app')

@section('title', 'share project')

@section('content')

<div class="container mt-5 p-5 border rounded">
    <h3>your friends:</h3>
    @forelse ($friends as $friend)
        <form action="/project/{{$project->id}}-{{Str::slug($project->title)}}/share" method="post" class="form-inline border p-3 rounded my-3">
            @csrf
            <h4><a href="/user/{{$friend->id}}" class="link-unstyled">{{$friend->name}} : {{ $friend->email}}</a></h4>
            <input type="hidden" name="friend_id" value="{{$friend->id}}">
            @if($friend->sharedProjects()->where('project_id', $project->id)->get()->Count() == 0)
            <button class="btn btn-primary mx-4">Share</button>
            @else
            <button class="btn btn-danger mx-4">Unshare</button>
            @endif
        </form>
    @empty
        <h4>you don't have any friends to share this project with.</h4>
    @endforelse
    <div class="mt-4">
        <a href="{{$friends->previousPageUrl()}}" class="btn btn-dark">previous</a><span class="mx-3">{{$friends->currentPage()}}</span><a href="{{$friends->nextPageUrl()}}"class="btn btn-dark">next</a>  
    </div>
</div>

@endsection