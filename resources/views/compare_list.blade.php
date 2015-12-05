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
        <form method="POST" action="/recentList">
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
                            <p class="store">{{$store[0][3]->getStoreType()}}</p>
                            <p class="store">{{$store[0][3]->address}}</p>
                            <p class="store">{{$store[0][3]->formatCityStateZip()}}</p>
                        </th>
                        @for ($i= 1; $i < 3; $i++)
                            <th class="col-xs-2">
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

                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->itemInfo->name }}</td>
                            <td class="success">{{ array_key_exists($item->item_info_id,$store[0][2]) ? '$' . $store[0][2][$item->item_info_id] : "No Price Found" }}</td>
                            @for ($i= 1; $i < 3; $i++)
                                <td>{{ array_key_exists($item->item_info_id,$store[$i][2]) ? '$' . $store[$i][2][$item->item_info_id] : "No Price Found" }}</td>
                            @endfor

                        </tr>
                    @endforeach

                    <tr class="item_row">

                        <td colspan="2"> <strong class="pull-right"> Price Totals: </strong></td>
                        <td class="success"><u><strong>{{ '$' . $store[0][1] }}</strong></u></td>
                        @for ($i= 1; $i < 3; $i++)
                            <td><strong>{{ '$' . $store[$i][1] }}</strong></td>
                        @endfor

                    </tr>
                    <tr class="no-border">
                        <td class="col-xs-1"></td>
                        <td class="col-xs-5"></td>
                        <td class="col-xs-2"><button name="choose_button-1" type="submit" class="btn btn-success">Choose Store</button></td>
                        <td class="col-xs-2"><button name="choose_button-2" type="submit" class="btn btn-primary">Choose Store</button></td>
                        <td class="col-xs-2"><button name="choose_button-3" type="submit" class="btn btn-primary">Choose Store</button></td>
                    </tr>
                    </tbody>


                </table>


            </div>
        </form>


    </div>

   <!-- </div>
    <div class="col-xs-offset-6 col-xs-2">

    </div>
    <div class="col-xs-2">
        <button name="store_choose_button" type="submit" class="btn btn-primary">Choose Store</button>
    </div>
    <div class="col-xs-2">
        <button name="store_choose_button" type="submit" class="btn btn-primary">Choose Store</button>
    </div> -->






@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var max_fields      = 100; //maximum input boxes allowed
            var wrapper         = $("#my_tbody"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = $('.item_row').length; //initlal text box count
            $(document).on("focus", "#bottom_item",function(e){ //on add input button click
                e.preventDefault();

                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $("#bottom_item").parent().parent().append('<td><button type="button" class="btn btn-danger delete-button" name="item-delete-button">X</button></td>');
                    $("#bottom_item").attr("id","item");
                    $(".new_checkbox").attr("class","slave_checkbox");
                    $("#my_tbody").append('<tr class="item_row">' +
                            '<td class="opt1">' +
                            '<input class="check-hide" type="hidden" name="active[]" value="1">' +
                            '<input class="new_checkbox"  type="checkbox" >' +
                            '</td>' +
                            '<td><input name="qty[]" type="text" class="form-control" id="qty" value="1"></td>' +
                            '<td><input name="name[]" type="text" class="form-control" tabindex="1" id="bottom_item" placeholder="New Item" value=""></td>' +
                            '</tr>');

                    //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                }
            });
            $(document).on("click",".delete-button", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('td').parent('tr').remove(); x--;
            })

            $("#master_checkbox").change(function(){
                if(this.checked){
                    var cur = $(".slave_checkbox");
                    $(cur).prop("checked", true);
                    $(cur).parent().parent().attr("class", "clicked");
                    $(cur).siblings('.check-hide').val(0);
                }
                else{
                    var cur = $(".slave_checkbox");
                    $(cur).prop("checked", false);
                    $(cur).parent().parent().attr("class", "");
                    $(cur).siblings('.check-hide').val(1);
                }
            });
            $(".slave_checkbox").each(function() {
                if (this.checked) {
                    $(this).parent().parent().attr("class", "clicked");
                }
            });
            $(document).on("change", ".slave_checkbox",function(){

                if(this.checked) {
                    $(this).parent().parent().attr("class", "clicked");
                    $(this).siblings('.check-hide').val(0);
                }
                else{
                    $(this).parent().parent().attr("class", "");
                    $(this).siblings('.check-hide').val(1);
                }

            });






        });

    </script>

@endsection