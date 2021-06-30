@extends('layouts.app')

@section('title', 'Friends')

@section('content')
<div class="container border rounded mt-5">
@forelse ($requestors as $requestor)
    <div class="row justify-content-center my-3">
        <a href="/user/{{$requestor->id}}" class="h3 mx-3">{{$requestor->name}}</a>
        <form action="/friend/request" method="post">
            @method('PATCH')
            @csrf
            <input type="hidden" name="requestor_id" value="{{$requestor->id}}">
            <button class="btn btn-success mx-2">Accept Request</button>
        </form>
        <form action="/relationship/{{$requestor->id}}" method="post">
            @method('delete')
            @csrf
            <input type="hidden" name="user_id" value="{{$requestor->id}}">
            <button class="btn btn-danger mx-2">delete request</button>
        </form>
    </div>
@empty
    <h3>you have no requests.</h3>
@endforelse


</div>
@endsection