
<!-- Stored in resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <!-- Bootstrap -->
        {!! HTML::style('resources/assets/css/bootstrap.min.css') !!}
        {!! HTML::style('resources/assets/css/custom.css') !!}
        <!-- Font just incase? -->
        <link href="https://fonts.googleapis.com/css?family=Noticia+Text" rel="stylesheet" type="text/css">
        <title> Go Buy Here @yield('title')</title>
        <style>
            img{
                width: 90%;
                height: auto;
            }
        </style>
        @yield('styles')
    </head>

    <body>
        <div class="container">
           <nav class="navbar navbar-default">
               <div class="container-fluid">
                   <!-- Brand and toggle get grouped for better mobile display -->
                   <div class="navbar-header">
                       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar-collapse-1" aria-expanded="false">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>
                       <a class="navbar-brand" href="{{ URL::to('') }}">Go Buy Here </a>
                   </div>

                   <!-- Collect the nav links, forms, and other content for toggling -->
                   <div class="collapse navbar-collapse" id="my-navbar-collapse-1">
                       <ul class="nav navbar-nav">
                           <li class="{{ (Request::is('/') ? 'active' : '') }}">
                               <a href="{{URL::to('/') }}"><i class="glyphicon glyphicon-home"></i> Home</a>
                           </li>
                           <li class="{{ (Request::is('shopping') ? 'active' : '') }}">
                               <a href="{{URL::to('shopping') }}"><i class="glyphicon glyphicon-list"></i> My Shopping List </a>
                           </li>
                           <li class="{{ (Request::is('items') ? 'active' : '') }}">
                               <a href="{{ URL::to('items') }}">Items</a></li>
                           <li class="dropdown">
                           </li>
                       </ul>

                       <ul class="nav navbar-nav navbar-right">
                           <li><a href="#">Account</a></li>
                           <li><a href="#">Logout?</a></li>
                       </ul>

                   </div>
               </div>
           </nav>


           <!--  {!! HTML::image('resources/assets/images/free-logo.jpg')!!}
            <div class="jumbotron">
            -->


            </div>
        </div>




        <div class="container">
            @yield('content')
        </div>

        <!-- JQuery -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        {!!    HTML::script('resources/assets/js/bootstrap.min.js') !!}

        @yield('scripts')

    </body>

</html>


