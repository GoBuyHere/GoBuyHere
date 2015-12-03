
@extends('layouts.master')

@section('title', ' | Items')



@section('content')
    <h3>Here are the Users: </h3>
    <br/><br/>
    @foreach ($items as $item)
        <p>Name: {{$user->name}}</p>
        <p>Email: {{$user->email}} </p>
        <br/>
    @endforeach
@endsection