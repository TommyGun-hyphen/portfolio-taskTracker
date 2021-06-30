@extends('layouts.app')
@section('title', 'Task Tracker')
@section('content')

<style>
.full-section{
    width:100%;
    margin: 0px;
    padding: 1em 0px;
    display: flex;
    align-items: center;
    justify-content:center;
    flex-direction: column;
}
.full-section > div {
    text-align:center;
}
body{
    background:#81f569;
}
</style>

<section class="full-section">
<div class="my-5">
    <h1>Welcome to Task Tracker</h1>
    <h5>A fully optimized task and habit tracking tool at your disposal</h5>
    <h1 class="my-5" style="font-size:4rem"><i class="fas fa-tasks"></i></h1>
</div>
<div>
    <a class="btn btn-danger px-4" href="/register">START NOW</a>
    <a class="btn btn-secondary px-4" href="/login">login</a>
</div>
</section>

@endsection