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

        body{
            margin-bottom:400px;
        }



    </style>
@endsection

@section('content')


    <div class="row">

        <form method="POST" action="/recent_new">
            {!! csrf_field() !!}
            <input type="hidden" name="groceryList" value="{{$list->name}}" >
            <div class="table-responsive">
                <table class="table ">
                    <caption> <h4>{{$list->name}}</h4> </caption>
                    <thead>
                    <tr>

                        <th class="col-xs-1">Qty</th>
                        <th class="col-xs-5">Item</th>
                        <th class="col-xs-2 success">
                            <input type="hidden" value="{{ $store[0][3]->id }}" name="store[]">
                            <p class="store">{{$store[0][3]->getStoreType()}}</p>
                            <p class="store">{{$store[0][3]->address}}</p>
                            <p class="store">{{$store[0][3]->formatCityStateZip()}}</p>
                        </th>
                        @for ($i= 1; $i < count($store); $i++)
                            <th class="col-xs-2">
                                <input type="hidden" value="{{ $store[$i][3]->id }}" name="store[]">
                                <p class="store">{{$store[$i][3]->getStoreType()}}</p>
                                <p class="store">{{$store[$i][3]->address}}</p>
                                <p class="store">{{$store[$i][3]->formatCityStateZip()}}</p>
                            </th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody id="my_tbody">
                    @foreach($items as $item)
                        <tr class="item_row">

                            <td>{{ $item->qty }} <input type="hidden" name="qty[]" value="{{ $item->qty }}"></td>
                            <td>{{ $item->itemInfo->name }} <input type="hidden" name="itemId[]" value="{{  $item->item_info_id }}"></td>
                            <td class="success">
                                {{ array_key_exists($item->item_info_id,$store[0][2]) ? '$' . $store[0][2][$item->item_info_id] : "No Price Found" }}
                            </td>
                            @for ($i= 1; $i < count($store); $i++)
                                <td>
                                    {{ array_key_exists($item->item_info_id,$store[$i][2]) ? '$' . $store[$i][2][$item->item_info_id] : "No Price Found" }}
                                </td>
                            @endfor

                        </tr>
                    @endforeach

                    <tr class="item_row">

                        <td colspan="2"> <strong class="pull-right"> Price Totals: </strong></td>
                        <td class="success"><u><strong>{{ '$' . $store[0][1] }}</strong></u></td>
                        @for ($i= 1; $i < count($store); $i++)
                            <td><strong>{{ '$' . $store[$i][1] }}</strong></td>
                        @endfor

                    </tr>
                    <tr class="no-border">
                        <td class="col-xs-1"></td>
                        <td class="col-xs-5"></td>
                        <td class="col-xs-2"><button value="0" name="choose_button" type="submit" class="btn btn-success">Choose Store</button></td>
                        @for ($i= 1; $i < count($store); $i++)
                            <td class="col-xs-2"><button value="{{$i}}" name="choose_button" type="submit" class="btn btn-primary">Choose Store</button></td>
                        @endfor
                         <!--<td class="col-xs-2"><button name="choose_button-2" type="submit" class="btn btn-primary">Choose Store</button></td>
                        <td class="col-xs-2"><button name="choose_button-3" type="submit" class="btn btn-primary">Choose Store</button></td> -->
                    </tr>
                    </tbody>


                </table>


            </div>
        </form>


    </div>



@endsection

