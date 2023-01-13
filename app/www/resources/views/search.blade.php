@extends ("layouts/index_layout")

@section('content')

    <div class="popularCollection mt-3 pt-3 mt-md-4 pt-md-4 mt-lg-5 pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headingWh mb-2 mb-md-4">Найдено</h2>
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
        </div>
    </div>

@endsection
