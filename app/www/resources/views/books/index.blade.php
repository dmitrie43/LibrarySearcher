@extends ("layouts/index_layout")

@section('content')

<div class="popularCollection mt-3 pt-3 mt-md-4 pt-md-4 mt-lg-5 pt-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="headingWh mb-2 mb-md-4">Библиотека</h2>
                <div class="filters d-none d-md-block">
                    <div class="filtertop">
                        <div class="filterLeft">
                            <div class="btn-group">
                                <button class="filterbtn dropdown-toggle text-start" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Все жанры
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($genres as $genre)
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route('books.index', array_merge($filter_params, ['genre' => $genre->id])) }}">{{$genre->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button class="filterbtn dropdown-toggle text-start" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Автор
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($authors as $author)
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route('books.index', array_merge($filter_params, ['author' => $author->id])) }}">{{$author->full_name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button class="filterbtn dropdown-toggle text-start" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Издательство
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($publishers as $publisher)
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route('books.index', array_merge($filter_params, ['publisher' => $publisher->id])) }}">{{$publisher->name}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="filterRight">
                            <button class="btn btnlightblue ms-md-auto"
                                    onclick="window.location.href='{{ route('books.index') }}'">Сбросить <img src="{{asset('img/closeicon.svg')}}" alt="img"></button>
                        </div>
                    </div>
                    <div class="filtertop">
                        <div class="filterLeft">

                            <div class="btn-group">
                                <button class="filterbtn dropdown-toggle text-start" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Дата
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sortBy' => 'date_publish', 'sort' => 'ASC']) }}">По возрастанию</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sortBy' => 'date_publish', 'sort' => 'DESC']) }}">По убыванию</a></li>
                                </ul>
                            </div>

                            <div class="btn-group">
                                <button class="filterbtn dropdown-toggle text-start" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Количество страниц
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sortBy' => 'pages_quantity', 'sort' => 'ASC']) }}">По возрастанию</a></li>
                                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['sortBy' => 'pages_quantity', 'sort' => 'DESC']) }}">По убыванию</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3 mt-md-5">
            @foreach($books as $book)
                <div class="col-md-6 col-xl-3 mb-4">
                    <a href="{{route('books.detail', ['id' => $book->id])}}">
                        <div class="aboutitem">
                            <div class="aboutitemImg">
                                <img class="img-fluid" src="{{asset($book->cover_img)}}" alt="img">
                            </div>
                            <div class="bgdarkbluecolor aboutitemcnt">
                                <div class="itemtitlecode">
                                    <h2 class="textgraycolor">{{$book->author->full_name}}</h2>
                                    <h3 class="textwhitecolor">{{$book->name}}</h3>
                                </div>
                                <div class="itemtitlePrice">
                                    <h2 class="textgraycolor">Дата публикации: {{$book->date_publish}}</h2>
                                    <h2 class="textwhitecolor">Страниц: {{$book->pages_quantity}}</h2>
                                    {{--<h4 class="textgraycolor"><span><img src="img/hearticon.svg"></span> 56</h4>--}}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{ $books->links('/components/links') }}

        <div class="row d-block d-md-none">
            <div class="col-md-12 text-center">
                <button type="button" class="btn btnlightblue filterbtnsm" data-bs-toggle="modal" data-bs-target="#filterModal">Filter</button>
            </div>
        </div>
    </div>
</div>

@endsection
