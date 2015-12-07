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
        @if(Session::has('gmessage'))
            <div class="alert alert-success alert-message"><strong>Nice! </strong> {{Session::get('gmessage')}} </div>
        @elseif(Session::has('imessage'))
            <div class="alert alert-info alert-message"><strong>Whoops! </strong> {{Session::get('imessage')}} </div>
        @endif
        <form method="POST" action="/recent">
            {!! csrf_field() !!}
            <input type="hidden" name="" value="" >
            <div class="table-responsive col-md-8 col-md-offset-2">
                <table class="table ">
                    <h4> Your Recent List: </h4>
                    <caption> <h4>{{$store->getStoreType()}}</h4><h4>{{$store->address}} </h4> <h4>{{$store->formatCityStateZip()}}</h4> </caption>
                    <thead>
                    <tr>
                        <!-- <p class="store"{{$store->getStoreType()}}</p>
                            <p class="store">{{$store->address}}</p>
                            <p class="store">{{$store->formatCityStateZip()}}</p> -->
                        <th class="col-xs-1">Qty</th>
                        <th class="col-xs-3">Item</th>

                        <th class="col-xs-2">Price for one</th>
                        <th class="col-xs-2">Price for Qty</th>
                        <th class="col-xs-4">What you paid for one</th>
                    </tr>
                    </thead>
                    <tbody id="my_tbody">
                    @foreach($recentListItems as $rItem)
                        <tr class="item_row">
                            <input type="hidden" value="{{$rItem->item->id}}" name="itemIds[]">
                            <td>{{ $rItem->qty }}</td>
                            <td>{{ $rItem->item->itemInfo->name }}</td>

                            <td class="store_price_for_one">{{ $rItem->item->hasPrice() ? $rItem->item->priceToReadable() : "No Price Found" }}</td>
                            <td class="store_price_for_one">{{ $rItem->item->hasPrice() ? $rItem->item->priceToReadable($rItem->qty) : "No Price Found" }}</td>
                            <td>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="text" class="form-control" id="exampleInputAmount" name="amount[]" placeholder="Amount">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    <tr class="item_row">

                        <td colspan="3"> <strong class="pull-right"> Price Total: </strong></td>
                        <td ><u><strong>{{ $total }}</strong></u></td>

                            <td></td>


                    </tr>
                    <tr class="no-border">
                        <td colspan=4 class="col-xs-8"></td>
                        <td colspan="1" class="col-xs-4 "><button name="save_prices" type="submit" class="btn btn-primary">Save My Prices</button></td>
                    </tr>
                    </tbody>


                </table>


            </div>
        </form>


    </div>



@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            window.setTimeout(function () {
                $(".alert-message").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 3000);
        });

    </script>
@endsection
