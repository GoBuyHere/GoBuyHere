@extends('layouts.master')

@section('title', ' | Compare List')


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
        tr.clicked {
            opacity:0.5;
            background-color:gainsboro;
        }


    </style>
@endsection

@section('content')


    <div class="row">
        @if(Session::has('gmessage'))
            <div class="alert alert-success alert-message"><strong>Nice! </strong> {{Session::get('gmessage')}} </div>
        @elseif(Session::has('bmessage'))
            <div class="alert alert-danger alert-message"><strong>Oh No! </strong> {{Session::get('bmessage')}} </div>
        @endif

        <form method="POST" action="/" name="item_form" id="item_form">
            {!! csrf_field() !!}
            <input type="hidden" name="groceryList" value="Shopping List" >
            <div class="table-responsive col-md-8 col-md-offset-2">
                <table class="table">
                    <caption> <h4>Shopping List</h4> </caption>
                    <thead>
                        <tr>
                            <th class="col-xs-1 opt1"><input type="checkbox" id="master_checkbox"></th>
                            <th class="col-xs-1 opt1">Qty</th>
                            <th class="col-xs-10 opt1">Item</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="my_tbody">
                    @foreach($items as $item)
                        <tr class="item_row">
                            <td class="opt1">
                                <input class="check-hide" type="hidden" name="active[]" value="{{  $item->active ? '1' : '0'}}">
                                <input class="slave_checkbox"  type="checkbox" {{  $item->active ? "" : 'checked=checked' }} ></td>
                            <td><input name="qty[]" type="text" class="form-control qty" id="qty" value="{{$item->qty}}"></td>
                            <td><input name="name[]" type="text" class="form-control" tabindex="1" id="item" placeholder="New Item" value="{{ $item->itemInfo->name }}"></td>
                            <td><button type="button" class="btn btn-danger delete-button" aria-label="Close"  name="item-delete-button">&times;</button></td>


                        </tr>
                    @endforeach
                        <tr class="item_row">
                            <td class="opt1">
                                <input class="check-hide" type="hidden" name="active[]" value="1">
                                <input name="active[]" class="slave_checkbox"  type="checkbox" >
                            </td>
                            <td><input name="qty[]" type="text" class="form-control qty" id="qty" value="1"></td>
                            <td><input name="name[]" type="text" class="form-control" tabindex="1" id="bottom_item" placeholder="New Item" value=""></td>

                        </tr>
                        <tr class="no-border">

                            <td class="col-xs-2" colspan="2">
                                <button id="save_button" name="save_button" type="submit" class="btn btn-primary"
                                                                     value="{{$user}}" @if($user == 0) data-toggle="modal" data-target=".login-modal"@endif>Save List</button>
                            </td>
                            <td class="col-xs-3">
                                <button id="comp_button" name="compare_button" type="submit" class="btn btn-success"
                                                         value="{{$user}}" @if($user == 0) data-toggle="modal" data-target=".login-modal"@endif>Compare Prices!</button>
                            </td>
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

            if($('#save_button').val() == 0){
                $('#item_form').submit(function(e){
                    e.preventDefault();
                    return false;
                });
                $('#save_button').removeAttr('type');
            }

            window.setTimeout(function () {
                $(".alert-message").fadeTo(500, 0).slideUp(500, function () {
                    $(this).remove();
                });
            }, 2000);


            var max_fields      = 100; //maximum input boxes allowed
            var wrapper         = $("#my_tbody"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            var x = $('.item_row').length; //initlal text box count
            $(document).on("focus", "#bottom_item",function(e){ //on add input button click
                e.preventDefault();

                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    var bottom = $("#bottom_item")
                    $(bottom).parent().parent().append('<td><button type="button" class="btn btn-danger delete-button" aria-label="Close" name="item-delete-button">&times</button></td>');
                    $(bottom).attr("id","item");
                    $(".new_checkbox").attr("class","slave_checkbox");
                    $(bottom).parent().parent().after('<tr class="item_row">' +
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