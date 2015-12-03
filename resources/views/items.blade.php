
@extends('layouts.master')

@section('title', ' | Items')



@section('content')
    <h3>Here are the Users: </h3>
    <br/><br/>
    @foreach ($items as $item)
        <p>{{$item->itemInfo->name }}</p>
        <ul>
            <li>
                Price: {{$item->price}}
            </li>
            <li>Store Info
                <ul>

                        <li>
                            {{$item->store->storeType->type}}
                        </li>
                        <li>
                            {{$item->store->address . ', ' . $item->store->city . ', ' . $item->store->state . ' ' . $item->store->zipcode }}
                        </li>

                </ul>
            </li>


        </ul>
        <br/>
    @endforeach
@endsection