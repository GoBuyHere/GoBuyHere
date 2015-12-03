
<!-- Stored in resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <!-- Bootstrap -->
        {!! HTML::style('css/bootstrap.min.css') !!}

        <!-- Font just incase? -->
        <link href="https://fonts.googleapis.com/css?family=Noticia+Text" rel="stylesheet" type="text/css">
        <title> Go Buy Here @yield('title')</title>
    </head>

    <body>

       <nav class="navbar navbar-inverse navbar-default">
           <div class="container">
               <!-- Brand and toggle get grouped for better mobile display -->
               <div class="navbar-header">
                   <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                       <span class="sr-only">Toggle navigation</span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                   </button>
                   <a class="navbar-brand" href="#">Go Buy Here</a>
               </div>

               <!-- Collect the nav links, forms, and other content for toggling -->
               <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                   <ul class="nav navbar-nav">
                       <li class="active"><a href="items">Link <span class="sr-only">(current)</span></a></li>
                       <li><a href="#">Link</a></li>
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                               <li><a href="#">Action</a></li>
                               <li><a href="#">Another action</a></li>
                               <li><a href="#">Something else here</a></li>
                               <li role="separator" class="divider"></li>
                               <li><a href="#">Separated link</a></li>
                               <li role="separator" class="divider"></li>
                               <li><a href="#">One more separated link</a></li>
                           </ul>
                       </li>
                   </ul>

                   <ul class="nav navbar-nav navbar-right">
                       <li><a href="#">Link</a></li>
                       <li><a href="#">Logout?</a></li>
                   </ul>
               </div><!-- /.navbar-collapse -->
           </div><!-- /.container-fluid -->
       </nav>



        <div class="container">
            @yield('content')
        </div>

        <!-- JQuery -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        {!!    HTML::script('js/bootstrap.min.js') !!}

        @yield('scripts')

    </body>

</html>

