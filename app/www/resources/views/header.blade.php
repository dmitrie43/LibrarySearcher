<!doctype html>
<html lang="en">
<head>
    <title>Library Searcher</title>
    <meta charset="utf-8">
    <meta name="Googlebot-News" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="robots" content="noimageindex">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
{{--    <link rel="stylesheet" media="all" href="{{asset('css/app.css')}}">--}}
    <link rel="stylesheet" media="all" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" media="all" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" media="all" href="{{asset('css/slick-theme.css')}}">
    <link rel="stylesheet" media="all" href="{{asset('css/style.css')}}">
    <link rel="icon" type="image/png" sizes="28x28" href="{{asset('favicon.png')}}">
    <meta name="theme-color" content="#sdfsf">
</head>
<body class="themebgcolor">
<div class="circlebg1"><img class="img-fluid" src="{{asset('img/circlebg19.svg')}}" alt="img"></div>
<div class="circlebg2"><img class="img-fluid" src="{{asset('img/circlebg20.svg')}}" alt="img"></div>
<div class="circlebg3"><img class="img-fluid" src="{{asset('img/circlebg21.svg')}}" alt="img"></div>

<!-- header -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="logo">
                    <a href="/">
                        <img class="img-fluid" src="{{asset('img/Mediamodifier-Design.svg')}}"
                             alt="img">
                    </a>
                </div>
                <div class="searchform d-none d-md-inline-flex">
                    <form>
                        <input type="text" name="SearchItem" placeholder="Поиск">
                        <button><img src="{{asset('img/searchicon.svg')}}" alt="img"></button>
                    </form>
                </div>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-content">
                    <div class="hamburger-toggle">
                        <div class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </button>
                <nav class="navbar navbar-expand-xl">

                    <div class="collapse navbar-collapse" id="navbar-content">
                        <div class="logo d-md-none">
                            <a href="/">
                                <img class="img-fluid" src="{{asset('img/Mediamodifier-Design.svg')}}"
                                     alt="img">
                            </a>
                        </div>
                        <div class="searchform d-md-none">
                            <form>
                                <input type="text" name="SearchItem"
                                       placeholder="Search items, collections and creators">
                                <button><img src="{{asset('img/searchicon.svg')}}" alt="img"></button>
                            </form>
                        </div>

                        <ul class="navbar-nav mr-auto mb-2 mb-lg-0">

                            <li class="nav-item active">
                                <a class="nav-link" href="/">Главная</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/books">Книги</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/collections">Подборки</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside">Разделы</a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item" href="/novelties">Новинки</a></li>
                                    <li><a class="dropdown-item" href="/popular">Популярное</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="/news">Новости</a>
                            </li>

                            <li class="nav-item dropdown d-xl-none">
                                <a class="nav-link" href="{{ url('/dashboard') }}">Профиль</a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Вход</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Регистрация</a></li>
                                </ul>
                            </li>


                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                   data-bs-auto-close="outside">Система</a>
                                <ul class="dropdown-menu shadow">
                                    <li><a class="dropdown-item" href="aboutus.html">О нас</a></li>
                                    <li><a class="dropdown-item" href="blogstyle1.html">Блог</a></li>
                                    <li><a class="dropdown-item" href="faq.html">Вопросы</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
                <div class="loginWallet d-none d-md-inline-flex">
                    <div class="dropdown me-md-3 me-lg-2 me-xl-1 me-xxl-3">
                        <a class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{asset('img/usericon.svg')}}" alt="img">
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @auth
                                <li><a href="{{ url('/dashboard') }}" class="dropdown-item">Профиль</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('login') }}">Вход</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Регистрация</a></li>
                            @endauth
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>
