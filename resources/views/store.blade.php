@extends('layouts.master')

@section('title', ' | Compare List')


@section('styles')
    <style>

        ul.connectedSortable { list-style-type:none;
            margin:0;
            padding:0;
            margin-bottom: 10px;
            min-height:50px;}
        li.store {
            margin: 5px;
            padding: 5px;
            width: 100%; }
        div.store1{
            background:#CBBEBA;
            color:black;
            border-radius:10px;
            padding: 5px;
            margin:10px;
        }
        div p{

            margin-bottom:0px;
        }
        div.store2{
            background:#f7812d;
            color:white;
        }
        div.store3{
            background:#3f46c1;
            color:white;
        }
        body{
            min-height:500px;
            margin-bottom:400px;
        }




    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

    <div class="row">

    @if(Session::has('gmessage'))
        <div class="alert alert-success alert-message"><strong>Nice! </strong> {{Session::get('gmessage')}} </div>
    @elseif(Session::has('imessage'))
        <div class="alert alert-info alert-message"><strong>Whoops! </strong> {{Session::get('imessage')}} </div>
    @elseif(Session::has('bmessage'))
        <div class="alert alert-danger alert-message"><strong>Oh No! </strong> {{Session::get('bmessage')}} </div>
    @endif

    <div class="col-md-4  col-xs-12">
        <h2 class="text-center">My Stores</h2>
        <form method="POST" action="stores" name="store_form">
        {!! csrf_field() !!}
        <div class="well">
                <ul id="sortable1" class="connectedSortable">
                    @foreach($myStores as $store)
                        <li class="ui-state-highlight" data-type="{{strtolower($store->getStoreType()) }}"
                            data-address="{{ strtolower($store->address) }}" data-city="{{  strtolower($store->city) }}"
                            data-state="{{ strtolower($store->state) }}" data-zip="{{ $store->zipcode }}">
                            <div class="store1">
                                <p class="text-right"><button type="button" class="btn btn-danger btn-xs rm-button">Remove</button></p>
                                <input type="hidden" name="store[]" value="{{$store->id}}">
                                <p class="text-center"><strong>{{ $store->getStoreType() }}</strong></p>
                                <p class="text-center"><strong>{{ $store->address }}</strong></p>
                                <p class="text-center"><strong>{{ $store->formatCityStateZip() }}</strong></p>
                            </div>
                        </li>
                    @endforeach
                </ul>

        </div>
        <button name="save_button" type="submit" class="btn btn-success pull-right" >Save Stores</button>
        </form>
    </div>

    <div class="col-md-4 col-xs-12">
        <h2 class="text-center">Available Stores</h2>
        <div class="well">
            <ul id="sortable2" class="connectedSortable">
                @foreach($otherStores as $store)
                    <li class="ui-state-highlight" data-type="{{strtolower($store->getStoreType()) }}"
                        data-address="{{ strtolower($store->address) }}" data-city="{{  strtolower($store->city) }}"
                        data-state="{{ strtolower($store->state) }}" data-zip="{{ $store->zipcode }}">
                        <div class="store1">
                                <p class="text-left"><button type="button" class="btn btn-primary btn-xs add-button">Add</button></p>
                                <input type="hidden" name="store[]" value="{{$store->id}}">
                                <p class="text-center"><strong>{{ $store->getStoreType() }}</strong></p>
                                <p class="text-center"><strong>{{ $store->address }}</strong></p>
                                <p class="text-center"><strong>{{ $store->formatCityStateZip() }}</strong></p>
                        </div>
                    </li>
                @endforeach
            </ul>


        </div>
    </div>
    <div class="col-md-4 col-xs-12">
        <h2 class="text-center">Filter Stores</h2>
        <div class="well">
            <div class="form-group">
                <label for="filter_storetype">Store Type</label>
                <input type="text" class="form-control" id="filter_storetype" placeholder="Ex: Walmart" >
            </div>
            <div class="form-group">
                <label for="filter_address">Address</label>
                <input type="text" class="form-control" id="filter_address" placeholder="Ex: 2300 McFarland Blvd" >
            </div>
            <div class="form-group">
                <label for="filter_city">City</label>
                <input type="text" class="form-control" id="filter_city" placeholder="Ex: Tuscaloosa">
            </div>
            <div class="form-group">
                <label for="filter_state">State</label>
                <input type="text" class="form-control" id="filter_state" placeholder="Ex: AL" >
            </div>
            <div class="form-group">
                <label for="filter_zipcode">Zipcode</label>
                <input type="text" class="form-control" id="filter_zipcode" placeholder="Ex: 35406" >
            </div>

        </div>

    </div>

</div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        window.setTimeout(function() {
            $(".alert-message").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);

        $(function() {
            $( "#sortable1, #sortable2" ).sortable({
                connectWith: ".connectedSortable"
            }).disableSelection();
        });
        $(document).on("click",".add-button", function(){
            var box = $(this).parent().parent();
            $(this).parent().replaceWith('<p class="text-right"><button type="button" class="btn btn-danger btn-xs rm-button">Remove</button></p>');
            $('#sortable1').append($(box));
        });
        $(document).on("click",".rm-button", function(){
            var box = $(this).parent().parent();
            $(this).parent().replaceWith('<p class="text-left"><button type="button" class="btn btn-primary btn-xs add-button">Add</button></p>');
            $('#sortable2').append($(box));
        });

        $( "#sortable1" ).on( "sortreceive", function( event, ui ) {
            //console.log($(ui).children().children());
            $(ui.item).children().children('p.text-left').each(function(){
                //console.log(this);
                $(this).replaceWith('<p class="text-right"><button type="button" class="btn btn-danger btn-xs rm-button">Remove</button></p>');
            });
        });
        $( "#sortable2" ).on( "sortreceive", function( event, ui ) {
            //console.log($(ui).children().children());
            $(ui.item).children().children('p.text-right').each(function(){
                //console.log(this);
                $(this).replaceWith('<p class="text-left"><button type="button" class="btn btn-primary btn-xs add-button">Add</button></p>');
            });
        });


        /* $("#sortable1").sortable({
              receive: function(event, ui){
                  $(ui).children('p.text-left').each(function(){
                      console.log(ui);
                      $(this).replaceWith('<p class="text-right"><button type="button" class="btn btn-danger btn-xs rm-button">Remove</button></p>');
                  });
              }
          }); */






        $(document).on("input","#filter_storetype, #filter_address, #filter_state, #filter_city, #filter_zipcode", function() {
            //change action
            var t_type = $('#filter_storetype').val().toLowerCase();
            console.log(1);
            var t_addr = $('#filter_address').val().toLowerCase();
            console.log(2);
            var t_state = $('#filter_state').val().toLowerCase();
            console.log(3);
            var t_city = $('#filter_city').val().toLowerCase();
            console.log(4);
            console.log(t_zip);
            var t_zip = $('#filter_zipcode').val().toString().toLowerCase();
            console.log(t_zip);

            $(document).ready(function(){

                $('#sortable2').children('li').each(function () {

                    if ((($(this).data('type').indexOf(t_type)) > -1) &&
                            (($(this).data('address').indexOf(t_addr)) > -1) &&
                            (($(this).data('city').indexOf(t_city)) > -1) &&
                            (($(this).data('state').indexOf(t_state)) > -1)  &&
                            (($(this).data('zip').toString().indexOf(t_zip)) > -1)){
                        $(this).show();
                    }
                    else {
                        $(this).hide();
                    }


                });
            });






        });




    });

</script>


@endsection

