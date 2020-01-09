<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>dIV Library</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .btn-upload {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn-upload input[type=file] {
            position: absolute;
            opacity: 0;
            z-index: 0;
            max-width: 100%;
            height: 100%;
            display: block;
        }

        .btn-upload .btn {
            padding: 8px 20px;
            background: #f4f4f4;
            border: 1px solid #adadad;
        }

        .btn-upload:hover .btn {
            padding: 8px 20px;
            background: #e6e6e6;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #222;
            color: white;
            text-align: center;
            padding: 10px;
        }
        #totalCart {
            position: absolute;
            top: -5px;
            width: 20px;
            background-color: #337ab7;
            border-radius: 100%;
        }

    </style>
</head>

<body id="app-layout">
    <nav class="navbar navbar-static-top navbar-inverse">
        <div class="container">
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php $time = date('d/m/Y H.i.s', strtotime('now')) ?>
                    <li style="color: #ffffff; background-color: transparent">Current Server Date Time : {{$time}}</li>
                    <br>
                    <li><a style="color: #ffffff; background-color: transparent" href="/">Books</a></li>
                    @guest
                    <!-- blank -->
                    @else
                    <li><a style="color: #ffffff; background-color: transparent" href="{{url('borrow-history')}}">Borrow History</a></li>
                    @if(Auth::user()->role == "admin")
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre style="color: #ffffff; background-color: transparent">
                            Master Page <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('manage-user')}}">User</a></li>
                            <li><a href="{{url('user-blacklisted')}}">User Blacklist</a></li>
                            <li><a href="{{url('manage-category')}}">Book Category</a></li>
                            <li><a href="{{url('manage-shelf')}}">Shelf</a></li>
                            <li><a href="{{url('manage-book')}}">Book</a></li>
                        </ul>
                    </li>

                    <li><a style="color: #ffffff; background-color: transparent" href="{{url('manage-transaction')}}">Manage Transaction</a></li>
                    @endif


                    @endguest
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @guest
                    <li style="margin-top: 20px"><a style="color: #ffffff; background-color: transparent" href="{{ route('login') }}">Login</a></li>
                    <li style="margin-top: 20px"><a style="color: #ffffff; background-color: transparent" href="{{ route('register') }}">Register</a></li>
                    @else
                    <li style="margin-top: 20px">
                        <a class="btn btn-primary" href="{{url('cart')}}" style="color: #ffffff; background-color: transparent">
                            <i class="fa fa-shopping-cart"> Cart</i>
                            @if((Auth::user()->role)=='member')
                            @if(isset($carts))
                                    <span id="totalCart">{{count($carts)}}</span>
                             @endif
                             @endif
                        </a>
                    </li>>
                    <li class="dropdown" style="margin-top: 20px">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre style="color: #ffffff; background-color: transparent">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('update-profile/'.Auth::user()->id)}}">Edit Profile</a></li>
                            <li><a href="{{url('update-account/'.Auth::user()->id)}}">Edit Account</a></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="footer">
        <span>Copyright &copy; Software Laboratory Center 2019</span>
    </div>

    <!-- JavaScripts -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html> 