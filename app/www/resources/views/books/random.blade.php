@extends ("layouts/index_layout")

@section('content')

<div class="popularCollection mt-3 pt-3 mt-md-4 pt-md-4 mt-lg-5 pt-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="headingWh mb-2 mb-md-4"><a href="{{route('books.random')}}">Перевыбрать</a></h2>
            </div>
            <div class="col-md-10 row mt-3 mt-md-3">
                <div class="col-md-6 col-xl-3 mb-4">
                    <a href="{{route('books.detail', ['book' => $book->id])}}">
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
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
