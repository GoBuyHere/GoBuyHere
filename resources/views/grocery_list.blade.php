@extends('layouts.master')

@section('title', ' | Shopping List')


@section('styles')
    <style>
        td.opt1 {
            text-align:center;
            vertical-align:middle;
            margin_top:20px;
        }
        th.opt1 {
            text-align:center;
            vertical-align:middle;
        }
    </style>
@endsection

@section('content')
    <h3>"Logged in" user: {{ $user->name }}</h3>


    <div class="table-responsive col-md-8 col-md-offset-2">
        <table class="table ">
            <caption> <h4>{{$list->name}}</h4> </caption>
            <thead>
                <tr>
                    <th class="col-xs-1 opt1"><input type="checkbox" id="master_checkbox"></th>
                    <th class="col-xs-2 opt1">Qty</th>
                    <th class="col-xs-9 opt1">Item</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="my_tbody">
            @foreach($items as $item)
                <tr>
                    <td class="opt1"><input class="slave_checkbox" class="form-control" type="checkbox" {{  $item->active ? "" : 'checked=checked' }} ></td>
                    <td><input type="text" class="form-control" id="qty" value="{{$item->qty}}"></td>
                    <td><input type="text" class="form-control" tabindex="1" id="item" placeholder="New Item" value="{{ $item->itemInfo->name }}"></td>
                    <td><button type="button" class="btn btn-danger" name="item-delete-button">X</button></td>

                </tr>

            @endforeach
                <tr>
                    <td class="opt1"><input class="slave_checkbox" class="form-control" type="checkbox" ></td>
                    <td><input type="text" class="form-control" id="qty" value="1"></td>
                    <td><input type="text" class="form-control" tabindex="1" id="bottom_item" placeholder="New Item" value=""></td>
                </tr>
            </tbody>

        </table>
        <div class="input_fields_wrap">
            <button class="btn add_field_button">Add More Fields</button>
            <div><input type="text" name="mytext[]"></div>
        </div>
    </div>




@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $("#my_tbody"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = 1; //initlal text box count
            $(document).on("focus", "#bottom_item",function(e){ //on add input button click
                e.preventDefault();

                if(x < 10){ //max input box allowed
                    x++; //text box increment
                    $("#bottom_item").parent().parent().append('<td><button type="button" class="btn btn-danger" name="item-delete-button">X</button></td>');
                    $("#bottom_item").attr("id","item");
                    $(".new_checkbox").attr("class","slave_checkbox");
                    $("#my_tbody").append('<tr>' +
                            '<td class="opt1"><input class="new_checkbox" class="form-control" type="checkbox" ></td>' +
                            '<td><input type="text" class="form-control" id="qty" value="1"></td>' +
                            '<td><input type="text" class="form-control" tabindex="1" id="bottom_item" placeholder="New Item" value=""></td>' +
                            '</tr>');

                    //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
                }
            });

            $("#master_checkbox").change(function(){
               if(this.checked){
                   $(".slave_checkbox").prop("checked", true);
               }
                else{
                   $(".slave_checkbox").prop("checked", false);
               }
            });

            $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })


        });

    </script>

@endsection