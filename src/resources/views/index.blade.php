<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{--{{ $title }}--}}</title>

    <!-- Bootstrap -->
    <script type="text/javascript" src={{asset('assets/js/jquery-1.11.3.min.js')}}></script>
    <script type="text/javascript" src={{asset('assets/js/bootstrap.min.js')}}></script>
    <script type="text/javascript" src={{asset('assets/js/moment-with-locales.min.js')}}></script>
    <script type="text/javascript" src={{asset('assets/js/bootstrap-datetimepicker.min.js')}}></script>
    <script type="text/javascript" src={{asset('assets/js/maskedinput.js')}}></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    <script type="text/javascript" src={{asset('assets/js/custom.js')}}></script>

    <link href={{asset('assets/css/bootstrap.min.css')}} rel="stylesheet" type="text/css"/>
    <link href={{asset('assets/css/bootstrap-theme.min.css')}} rel="stylesheet" type="text/css"/>
    <link href={{asset('assets/css/bootstrap-datetimepicker.min.css')}} rel="stylesheet" type="text/css"/>
    <link href={{asset('assets/css/font-awesome.css')}} rel="stylesheet" type="text/css"/>
    <link href={{asset('assets/css/bootstrap-social.css')}} rel="stylesheet" type="text/css"/>
    <link href={{asset('styles/style.css')}} rel='stylesheet' type='text/css'/>

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="navbar-header">
                    @if (Auth::guest())
                        <a class="navbar-brand" href={{asset('registrat/form')}}>Conference</a>
                    @else
                        <a class="navbar-brand" href={{asset('list/show')}}>Conference</a>
                    @endif
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        @if (Auth::guest())
                            <li @if (Route::currentRouteName() == 'regMembers') class="active" @endif><a href={{asset('registrat/form')}}>Registration</a></li>
                        @endif
                        <li @if (Route::currentRouteName() == 'listMembers') class="active" @endif ><a href={{asset('list/show')}}>All members</a></li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                            <li @if (Route::currentRouteName() == 'dashboard') class="active" @endif ><a href={{asset('dashboard')}}>Login</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                                </ul>
                            </li>
                        @endif
                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>
</nav>


@yield('content')

        <!-- <div> --Footer-- </div> -->
</body>
</html>
