@extends('layouts.master')

@section('title', ' | Compare List')


@section('styles')
    <style>
        td.opt1 {
            text-align:center;
            vertical-align:middle;
            margin_top:30px;
        }
        th.opt1 {
            text-align:center;
            vertical-align:middle;
        }
        tr.clicked {
            opacity:0.5;
            background-color:gainsboro;
        }
        p.store{
            margin-bottom:0px;
        }



    </style>
@endsection

@section('content')


    <div class="row">
        <h2 class="text-center"> {{$message}}</h2>
    </div>



@endsection
