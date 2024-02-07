@extends ("layouts/index_layout")

@section('content')

    <div class="popularCollection mt-3 pt-3 mt-md-4 pt-md-4 mt-lg-5 pt-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headingWh mb-2 mb-md-4">Авторы</h2>
                </div>
            </div>

            <div class="row mt-3 mt-md-5">
                @foreach($authors as $author)
                    <div class="col-md-6 col-xl-3 mb-4">
                        <a href="{{route('authors.detail', ['id' => $author->id])}}">
                            <div class="aboutitem">
                                <div class="aboutitemImg">
                                    <img class="img-fluid"
                                         src="{{isset($author->photo) ? asset($author->photo) : asset('img/author_default.png')}}"
                                         alt="img">
                                </div>
                                <div class="bgdarkbluecolor aboutitemcnt">
                                    <div class="itemtitlecode">
                                        <h2 class="textgraycolor">{{$author->full_name}}</h2>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            @if($authors->hasPages())
                {{ $authors->links('/components/links') }}
            @endif

        </div>
    </div>

@endsection
