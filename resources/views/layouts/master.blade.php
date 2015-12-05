
<!-- Stored in resources/views/layouts/master.blade.php -->
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <!-- Bootstrap -->
        {!! HTML::style('resources/assets/css/bootstrap.min.css') !!}
        {!! HTML::style('resources/assets/css/custom.css') !!}
        <!-- Font just incase? -->
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Noticia+Text" rel="stylesheet" type="text/css">
        <title> Go Buy Here @yield('title')</title>
        <style>
            img{
                width: 100%;
                height: auto;
            }
            .head_img{
                width:70%;

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
                       <a href="{{ URL::to('/') }}" class="pull-left">
                           {!! HTML::image('/resources/assets/images/Logo2.jpg','Go Buy Here',['class' => 'img-responsive visible-xs']) !!}
                       </a>

                       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar-collapse-1" aria-expanded="false">
                           <span class="sr-only">Toggle navigation</span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                           <span class="icon-bar"></span>
                       </button>


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
                           @if(Auth::check())
                               <li><p class="navbar-text">Hello, {{Auth::user()->name}}</p></li>
                               <li><button type="button" class="btn btn-danger navbar-btn" onclick="location.href='{{ URL::to('auth/logout') }}';" >Logout</button></li>
                           @else
                               <li style="margin-right:10px"><button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target=".login-modal" value="Login">Login</button></li>
                               <li><button type="button" class="btn btn-success navbar-btn" data-toggle="modal" data-target=".login-modal" value="Signup">Signup</button></li>
                           @endif
                       </ul>

                   </div>
               </div>
           </nav>


            <a href="{{ URL::to('/') }}">
                {!!  HTML::image('/resources/assets/images/Logo2.jpg','Go Buy Here',['class' => 'img-responsive hidden-xs']) !!}
            </a>



            </div>
        </div>




        <div class="container">
            @yield('content')
        </div>

        <!-- Login Modal -->

        <div id="login-overlay" class="modal fade login-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Login to GoBuyHere</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="well">

                                    <form id="loginForm" method="POST" action="/auth/login">
                                        {!! csrf_field() !!}

                                        <div class="form-group">
                                            <label for="email" class="control-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="control-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                                            <span class="help-block"></span>
                                        </div>
                                        <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" id="remember"> Remember login
                                            </label>

                                        </div>
                                        <button type="submit" class="btn btn-success btn-block">Login</button>

                                    </form>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <p style="margin-bottom:1px" class="lead">Don't have an Account?</p>
                                <p class="lead">Register now for <span class="text-success">FREE</span></p>
                                <ul class="list-unstyled" style="line-height: 2">
                                    <li><span class="fa fa-check text-success"></span> Save your shopping lists</li>
                                    <li><span class="fa fa-check text-success"></span> Find the best prices in town</li>
                                    <li><span class="fa fa-check text-success"></span> Contribute to price tracking</li>
                                    <li><span class="fa fa-check text-success"></span> Be Awesome</li>
                                </ul>
                                <p><a href="auth/register" class="btn btn-info btn-block">Yes please, register now!</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- JQuery -->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

        {!!    HTML::script('resources/assets/js/bootstrap.min.js') !!}

        @yield('scripts')

    </body>

</html>


