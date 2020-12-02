<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CNMI HELPDESK</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    CNMI:HELPDESK
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/apk/1.0.5.apk')}}">Dowload App</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- <footer>
        <h6 class="float-right" style="color: gray;">Power BY Phongsathorn Boonchu</h6>
    </footer> -->
    
</body>
<div class="FooterSmall__CopyRight-sc-1093s7q-0 RostK">
        <div class="CMSV2__Wrapper-fShGfv ckYCpm">
            <div id="cms-5d1b070576a1ab001511e961" class="GrapesViewer__CustomWrapper-fLnJQO gOoWFR">
                <div>
                    <div><span class="footer-copy-right-gjs float-right powerby" style="color: gray;">© 2020 Power By Phongsathorn Boonchu </span></div>
                </div>
                <style>
                    * {
                        box-sizing: border-box;
                    }

                    body {
                        margin: 0;
                    }

                    * {
                        box-sizing: border-box;
                    }

                    .powerby {
                        margin-top: 600px;
                        margin-right: 800px;
                        margin-bottom: 0px;
                        margin-left: 0px;
                    }

                    #cms-5d1b070576a1ab001511e961 .footer-copy-right-gjs {
                        font-size: 14px;
                        color: #000;
                    }
                </style>
            </div>
        </div>
    </div>

</html>