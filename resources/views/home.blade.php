<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>diV Library</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
        integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
         html {
            scroll-behavior: smooth;
        }

        .navbar-collapse {
            margin: 5px;
        }

        #app {
            background: url({{url('/images/background.jpg')}});
            height: 100vh;
            background-repeat: no-repeat;
            background-size: cover;
        }

        #content {
            min-height: 100vh;
        }

        #scrollButton {
            position: absolute;
            bottom:   0;
            width: 100%;
            text-align: center;
        }

        #totalCart {
            position: absolute;
            top: -5px;
            width: 20px;
            background-color: #337ab7;
            border-radius: 100%;
        }

        .book {
            margin: 10px;
            border: 1px solid #ddd;
        }

        .book-content {
            height: 120px;
            margin: 20px;
            text-align: center;
            vertical-align: middle;
        }

        .book-footer {
            margin: 10px;
            text-align: center;
            vertical-align: middle;
        }

        .footer {
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #222;
            color: white;
            text-align: center;
            padding: 10px;
        }
        .servertime #clockDisplay {
            position: relative;
            top: 15px;
            color: white;
            padding-right: 400px;

        }

    </style>
</head>

<body>
    <div id="app" style="height: 100vh;">
        <nav class="navbar bg-transparent">
            <div class="container">
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <div class="servertime">
                        <div id="clockDisplay"> </div>
                    </div>
                    <ul class="nav navbar-nav">

                        <br>
                        <li><a style="color: #ffffff; background-color: transparent" href="/">Books</a></li>
                        @guest
                        <!-- blank -->
                        @else
                        <li><a style="color: #ffffff; background-color: transparent"
                                href="{{url('borrow-history')}}">Borrow History</a></li>
                        @if(Auth::user()->role == "admin")
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false" aria-haspopup="true" v-pre
                                style="color: #ffffff; background-color: transparent">
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
                        <li><a style="color: #ffffff; background-color: transparent"
                                href="{{url('manage-transaction')}}">Manage Transaction</a></li>
                        @endif
                        @endguest
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @guest
                        <li style="margin-top: 20px"><a style="color: #ffffff; background-color: transparent"
                                href="{{ route('login') }}">Login</a></li>
                        <li style="margin-top: 20px"><a style="color: #ffffff; background-color: transparent"
                                href="{{ route('register') }}">Register</a></li>
                        @else
                        <li style="margin-top: 20px">
                            <a class="btn btn-primary" href="{{url('cart')}}"
                                style="color: #ffffff; background-color: transparent">
                                <i class="fa fa-shopping-cart"> Cart</i>
                                @if(isset($carts))
                                <span id="totalCart">{{count($carts)}}</span>
                                @endif
                            </a>
                        </li>
                        <li class="dropdown" style="margin-top: 20px">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false" aria-haspopup="true" v-pre
                                style="color: #ffffff; background-color: transparent">
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

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
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

        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4" style="margin-top: 10%">
                    <h4 style="text-align: center; color: #ffffff">Welcome To dIV Library</h4>
                    <p style="text-align: center; color: #ffffff">
                        Bad libraries build collections, good libraries <br>
                        build services, great libraries build <br>
                        communities
                    </p>
                    <hr>
                    <p style="text-align: center; color: #ffffff">by R. David Lankes</p>
                </div>
            </div>
        </div>

        <div id="scrollButton">
            <a href="#content" class="btn btn-link"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>

    <div id="content" style="height: 100vh;">
        <nav class="navbar navbar-static-top navbar-inverse">
            <div class="container">
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <div class="servertime">
                        <div id="clockDisplay"> </div>
                    </div>
                    <ul class="nav navbar-nav">
                        <!-- <?php $time = date('d/m/Y H.i.s', strtotime('now'))?>
                    <li style="color: #ffffff; background-color: transparent">Current Server Date Time : {{$time}}</li> -->
                        <br>
                        <li><a style="color: #ffffff; background-color: transparent" href="/">Books</a></li>
                        @guest
                        <!-- blank -->
                        @else
                        <li><a style="color: #ffffff; background-color: transparent"
                                href="{{url('borrow-history')}}">Borrow History</a></li>
                        @if(Auth::user()->role == "admin")
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false" aria-haspopup="true" v-pre
                                style="color: #ffffff; background-color: transparent">
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
                        <li><a style="color: #ffffff; background-color: transparent"
                                href="{{url('manage-transaction')}}">Manage Transaction</a></li>
                        @endif
                        @endguest
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @guest
                        <li style="margin-top: 20px"><a style="color: #ffffff; background-color: transparent"
                                href="{{ route('login') }}">Login</a></li>
                        <li style="margin-top: 20px"><a style="color: #ffffff; background-color: transparent"
                                href="{{ route('register') }}">Register</a></li>
                        @else
                        <li style="margin-top: 20px">
                            <a class="btn btn-primary" href="{{url('cart')}}"
                                style="color: #ffffff; background-color: transparent">
                                <i class="fa fa-shopping-cart"> Cart</i>
                                @if(isset($carts))
                                <span id="totalCart">{{count($carts)}}</span>
                                @endif
                            </a>
                        </li>
                        <li class="dropdown" style="margin-top: 20px">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-expanded="false" aria-haspopup="true" v-pre
                                style="color: #ffffff; background-color: transparent">
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

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
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

        <div class="container">
            @guest
            <div class="row">
                <div class="col-md-4 col-md-offset-4" style="margin-top: 5%">
                    <h3 style="text-align: center;">
                        <strong>Featured Books</strong>
                    </h3>
                    <p style="text-align: center;">
                        Below is some books in our library
                    </p>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col-md-12" style="margin: 25px">
                    <form action="{{url('books-search')}}" method="POST">
                        {{csrf_field()}}
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Search by Book Name, Book Description, Book Category Name, or Shelf Location">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @if(isset($search))
                <div class="col-md-12" style="margin: 25px">
                    <p>Your Search Result with '<b>{{$search}}</b>' Keyword(s)</p>
                </div>
                @endif
            </div>
            @endguest

            <div class="row">
                <div class="col-md-12">
                    @foreach($books as $book)
                    <div class="col-md-3">
                        <div class="book">
                            <div class="book-content">
                                <p><strong>{{$book->name}}</strong></p>
                                <p>{{$book->description}}</p>
                            </div>
                            <hr style="border-top: 1px solid #ddd; margin: 0">
                            <div class="book-footer">
                                <a href="{{url('book-detail/'.$book->id)}}">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="col-md-12" style="text-align: center; margin-top: 20px">
                    @guest
                    @if($flag == '0')
                    <a href="{{url('/seeAllBooks')}}">See All Books</a>
                    @else
                    {{$books->links()}}
                    @endif
                    @else
                    {{$books->links()}}
                    @endguest
                </div>
            </div>
        </div>

        <div id="scrollButton">
            <a href="#content" class="btn btn-link"><i class="fa fa-chevron-down"></i></a>
        </div>
    </div>

    <div class="footer">
        {{--<span>Copyright &copy; Software Laboratory Center 2019</span>--}}
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/clock.js') }}"></script>
</body>

</html>