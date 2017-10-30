<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/lib/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/bootstrap-switch.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/checkbox3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lib/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/theme/flat-blue.css') }}" rel="stylesheet">
</head>
<body class="flat-blue">
<div class="app-container expanded" id="app">
    <div class="row content-container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-expand-toggle fa-rotate-90">
                        <i class="fa fa-bars icon"></i>
                    </button>
                    <ol class="breadcrumb navbar-breadcrumb">
                        <li class="active">Dashboard</li>
                    </ol>
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-th icon"></i>
                    </button>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                        <i class="fa fa-times icon"></i>
                    </button>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li class="title">
                                Notification <span class="badge pull-right">{{ count(Auth::guard('admin')->user()->unreadNotifications) }}</span>
                            </li>
                            @foreach(Auth::guard('admin')->user()->unreadNotifications as $notification)
                                <li class="message">
                                    <a href="{{ route('notification.show',['id'=>$notification->id]) }}">{{ $notification->data['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown profile">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::guard('admin')->user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu animated fadeInDown">
                            <li class="profile-img">
                                <img src="/image/profile/picjumbo.com_HNCK4153_resize.jpg" class="profile-img">
                            </li>
                            <li>
                                <div class="profile-info">
                                    <h4 class="username">{{ Auth::guard('admin')->user()->name }}</h4>
                                    <p>{{ Auth::guard('admin')->user()->role }}</p>
                                    <div class="btn-group margin-bottom-2x" role="group">
                                        <button type="button" class="btn btn-default" onclick="window.location.href='{{ route('admin.profile') }}'"><i class="fa fa-user"></i> Profile</button>
                                        <a href="{{ route('admin.loginout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" type="button" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('admin.loginout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="side-menu sidebar-inverse">
            <nav class="navbar navbar-default" role="navigation">
                <div class="side-menu-container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <div class="icon fa fa-paper-plane"></div>
                            <div class="title">Gone's Admin</div>
                        </a>
                        <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                    </div>
                    @include('admin.layouts.permissions')
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
        <!-- Main Content -->
        <div class="container-fluid">
            <div class="side-body padding-top">
                @yield('content')
            </div>
        </div>
    </div>
    <footer class="app-footer">
        <div class="wrapper">

        </div>
    </footer>
</div>
<!-- Scripts -->
<!--<script src="{{ asset('js/lib/jquery.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lib/Chart.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('js/lib/jquery.matchHeight-min.js') }}"></script>
<script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/lib/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lib/select2.full.min.js') }}"></script>
<script src="{{ asset('js/theme/app.js') }}"></script>-->

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/function.js') }}"></script>
</body>
</html>
