@extends('layouts.app')

@section('title', 'Friends')

@section('content')
<div class="container border rounded mt-5">
@forelse ($friends as $friend)
    <div class="row justify-content-center">
        <a href="/user/{{$friend->id}}" class="h3">{{$friend->name}} :</a><span class="h3">{{$friend->email}}</span>

    </div>
@empty
    <h3>you have no friends yet.</h3>
@endforelse


</div>
@endsection