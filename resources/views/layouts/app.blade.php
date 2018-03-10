<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" style="height: 100%;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CTC Members') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/master.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>
    <style>

    body {
      padding-top: 70px;
      background-color: black;
      background: linear-gradient( rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4) ), url('/media/smoky-theatre.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    @media (min-width:641px) {

        .center-vertically {
            height: 80vh;

            align-items: center;
            display: flex;
            justify-content: center;

            position: relative;
        }

        .scrollbox {
          height: 85vh;
          overflow-y: scroll;
          padding-top: 2vh;
        }

        .dark-transparency {
          background-color: rgba(0, 0, 0, 0.5);
          color:white;
        }

        .light-transparency {
          background-color: rgba(255, 255, 255, 0.9);
          color:black;
        }

      }

      /*\
       * Restore Bootstrap 3 "hidden" utility classes.
      \*/

      /* Breakpoint XS */
      @media (max-width: 575px)
      {
          .hidden-xs-down, .hidden-sm-down, .hidden-md-down, .hidden-lg-down, .hidden-xl-down,
          .hidden-xs-up,
          .hidden-unless-sm, .hidden-unless-md, .hidden-unless-lg, .hidden-unless-xl
          {
              display: none !important;
          }

      }

      /* Breakpoint SM */
      @media (min-width: 576px) and (max-width: 767px)
      {
          .hidden-sm-down, .hidden-md-down, .hidden-lg-down, .hidden-xl-down,
          .hidden-xs-up, .hidden-sm-up,
          .hidden-unless-xs, .hidden-unless-md, .hidden-unless-lg, .hidden-unless-xl
          {
              display: none !important;
          }
      }

      /* Breakpoint MD */
      @media (min-width: 768px) and (max-width: 991px)
      {
          .hidden-md-down, .hidden-lg-down, .hidden-xl-down,
          .hidden-xs-up, .hidden-sm-up, .hidden-md-up,
          .hidden-unless-xs, .hidden-unless-sm, .hidden-unless-lg, .hidden-unless-xl
          {
              display: none !important;
          }
      }

      /* Breakpoint LG */
      @media (min-width: 992px) and (max-width: 1199px)
      {
          .hidden-lg-down, .hidden-xl-down,
          .hidden-xs-up, .hidden-sm-up, .hidden-md-up, .hidden-lg-up,
          .hidden-unless-xs, .hidden-unless-sm, .hidden-unless-md, .hidden-unless-xl
          {
              display: none !important;
          }
      }

      /* Breakpoint XL */
      @media (min-width: 1200px)
      {
          .hidden-xl-down,
          .hidden-xs-up, .hidden-sm-up, .hidden-md-up, .hidden-lg-up, .hidden-xl-up,
          .hidden-unless-xs, .hidden-unless-sm, .hidden-unless-md, .hidden-unless-lg
          {
              display: none !important;
          }
      }

    </style>

</head>
<body>
    <div id="app">

      <nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="background-color: #222;">
        <div class="container">


        {{-- <a class="navbar-brand" href="#">CTC Members</a> --}}

        <a class="navbar-brand" href="@guest {{url('/home')}} @else {{url('/home') }} @endguest">
          <img src="/media/logo_dark.png" style="display: inline; width: 37px;"/>
            &nbsp; {{ config('app.name', 'CTC Members') }}
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">

            <!-- Authentication Links -->
            @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="/membership">
                    Membership List
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="http://ctc-members.dk/a6de1850-21c1-4ca2-87e0-253c61bee591/seasons/" target="_blank">
                    Accounts
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Bulletin Board</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Handbook</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">CTCDB+</a>
              </li>
              <li class="nav-item dropdown">

                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="/profile">
                              Edit Profile
                          </a>
                          <a class="dropdown-item" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                              Logout
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              {{ csrf_field() }}
                          </form>

                  </div>
              </li>

              @endguest

            </ul>
          </div>

          </div>

        </nav>


            {{-- <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            --}}


        {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                      <img src="/media/logo_dark.png" style="display: inline; width: 37px;"/>
                        &nbsp; {{ config('app.name', 'CTC Members') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                          <li>
                            <a href="/membership" role="button" aria-expanded="false">
                                Membership List
                            </a>
                          </li>
                          <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Bulletin Board
                            </a>
                          </li>
                          <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Handbook
                            </a>
                          </li>

                          <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                CTCDB+
                            </a>
                          </li>
                          <li>
                              <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                  Logout
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                              </form>
                          </li>
                          <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Accounts<span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                              <li>
                                  <a href="#">
                                      Seasons
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      Shows
                                  </a>
                              </li>

                            </ul>
                          </li>
                            <li class="dropdown">

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="#">
                                            Edit Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
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
        </nav> --}}

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
