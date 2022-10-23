<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="日韓の相互に対するQ＆Aサイト。韓国について気になることや日本について気になることを質問してみましょう。">
        <meta name="keywords" content="日韓,韓国,質問">
        <meta name="google-site-verification" content="5rKIuo6XpiRlbfV9puQaclbGoLgFX0vwWhIfqsM7h6Y" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>@yield('title') | {{ config('app.name') }}</title>
    
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-1.12.4.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/js/lightbox.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
        <!-- Styles -->
        <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel ="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.7.1/css/lightbox.css" rel="stylesheet">
        
        <!--twitterシェア時のリンクカード設定 -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="日韓質問 han-il jil-mun" />
        <meta name="twitter:description" content="日韓相互間におけるQ&Aサイトです。" />
        <meta name="twitter:image" content="https://han-il-jil-mun.s3.ap-northeast-1.amazonaws.com/twitter-card-logo.png" />
    </head>
    <body>
        <div id="app">
            @if(!\Route::is('login'))
                @if(!\Route::is('register'))
                    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{ asset('han-il-jil-mun_logo.PNG') }}" alt="website logo" class="logo" width="200">
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
                                            <a class="nav-menu-link pr-4 text-nowrap" href="/how-to-use">
                                                このサイトの使い方&thinsp;<i class="far fa-question-circle"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-menu-link pr-4 text-nowrap" href="{{ route('login') }}">
                                                {{ __('Login') }}
                                            </a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-menu-link pr-4 text-nowrap" href="{{ route('register') }}">
                                                    {{ __('Register') }}
                                                </a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-menu-link profile-edit-button pr-4 text-nowrap" href="/how-to-use">
                                                このサイトの使い方&thinsp;<i class="far fa-question-circle"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-menu-link profile-show-button pr-4 text-nowrap" href="{{ route('users.show', ['user' => Auth::user()->id]) }}">
                                                {{ Str::limit( Auth::user()->name, 20) }}&thinsp;<i class="far fa-user"></i>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-menu-link text-nowrap" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                ログアウト<i class="fas fa-door-open"></i>
                                            </a>
                                        </li>
        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>
                    
                    <div class="header-end">
                    </div>
                @endif
            @endif
            <main class="py-sm-5">
                @yield('content')
            </main>
            @if(\Route::is('home'))
                <div class="footer-start">
                </div>
                
                <div class="footer bg-white">
                    <div class="footer-container px-5 pt-4 pb-2">
                        <div class="footer-logo ml-sm-5">
                            <img src="{{ asset('han-il-jil-mun_logo.PNG') }}" alt="website logo" class="logo footer-logo-img">
                        </div>
                        
                        <div class="privacy copy-right text-center">
                            <a href="/privacy">プライバシーポリシー・免責事項</a></br>
                            <small>Copyright © 2022 Iida-K All Rights Reserved.</small>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </body>
</html>