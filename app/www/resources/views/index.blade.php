@extends ("layouts/index_layout")

@section('content')

    <!-- banner sec -->
    <div class="bannerSec">
        @if($noveltyBooks->isNotEmpty())
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bannercntSec">
                            <div class="bannerImg">
                                @foreach($noveltyBooks as $noveltyBook)
                                    <a href="{{route('books.detail', ['book' => $noveltyBook->id])}}">
                                        <div class="bannerimg0{{++$loop->index}} d-none d-md-block novelty-book">
                                            <img class="img-fluid" width="252" height="309"
                                                 src="{{asset($noveltyBook->cover_img)}}" alt="img">
                                        </div>
                                    </a>
                                @endforeach
                                <div class="bannerbtn 1d-block d-none d-sm-none d-md-block d-xl-none mt-0 mt-md-4">
                                    <button class="btn btnlightblue me-3">Смотреть все</button>
                                </div>
                            </div>

                            <div class="bannercnt">
                                <h2 class="textwhitecolor">Новинки литературы</h2>
                                <p class="textbluecolor text-uppercase">Читайте новое, читайте с нами!</p>
                                <p class="textgraycolor">Литература не стоит на месте</p>
                                <div class="bannerbtn d-block d-sm-block d-md-none d-lg-none d-xl-block">
                                    <a href="">
                                        <button class="btn btnlightblue me-3">Смотреть все</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>


    <!-- Popular collections -->
    <div class="popularCollection">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headingWh mb-4">Книги по жанрам</h2>
                    <div class="tab-sec">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link d-none d-sm-none d-md-block active" data-bs-toggle="tab" onclick="getBooks()">Все</button>
                                @foreach($genres as $genre)
                                    @if($loop->iteration > 3)
                                        @break
                                    @endif
                                    <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab" onclick="">{{$genre->name}}</button>
                                @endforeach
                                <div class="more-tab">
                                    <a href="javascript:void(0)" class="textbluecolor categorytab">Выберите жанр <img
                                            src="{{asset('img/bluedown.png')}}" alt="arrow-down"></a>
                                    <div class="more-box nav nav-tabs" id="more_tab" role="tablist">
                                        @foreach($genres as $genre)
                                            <button class="nav-link" data-bs-toggle="tab" onclick="getBooksByGenre({{$genre->id}});">{{$genre->name}}</button>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active">
                                <div class="popular slider" id="books-by-genre">
                                    @foreach($books as $book)
                                        <div class="creators">
                                            <a href="{{route('books.detail', ['book' => $book->id])}}">
                                                <div class="creatorImg">
                                                    <img class="img-fluid" src="{{$book->cover_img}}" alt="img">
                                                </div>
                                                @if(!empty($book->author->photo))
                                                    <div class="creatorIcon">
                                                        <img class="img-fluid" src="{{$book->author->photo}}" alt="">
                                                        <div class="creatorcheck"><img src="{{asset('img/checkicon.svg')}}" alt="img"></div>
                                                    </div>
                                                @endif
                                                <div class="creatorsText text-center">
                                                    <h2 class="textwhitecolor">{{$book->author->name}}</h2>
                                                    <h3 class="textbluecolor">{{$book->author->full_name}}</h3>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Top sellers -->
    <?php /*
<div class="TopsellerSec pt-5 mt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="headingWh mb-4">Top sellers</h2>
                <div class="tab-sec">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link d-none d-sm-none d-md-block active" data-bs-toggle="tab"
                                    data-bs-target="#SellerTabOne">All
                            </button>
                            <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab"
                                    data-bs-target="#SellerTabTwo">24 Hours
                            </button>
                            <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab"
                                    data-bs-target="#SellerTabThree">Last week
                            </button>
                            <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab"
                                    data-bs-target="#SellerTabFour">Last month
                            </button>

                            <div class="more-tab d-block d-sm-block d-md-none">
                                <a href="javascript:void(0)" class="textbluecolor categoryTimeTab">Choose category <img
                                        src="img/bluedown.png" alt="arrow-down"></a>
                                <div class="more-box nav nav-tabs" id="timeTab" role="tablist">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#SellerTabOne">
                                        All
                                    </button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#SellerTabTwo">24
                                        Hours
                                    </button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#SellerTabThree">Last
                                        week
                                    </button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#SellerTabFour">Last
                                        month
                                    </button>
                                </div>
                            </div>


                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="SellerTabOne">
                            <div class="topSellers">
                                <ul>
                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">1</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg01.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">2</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg02.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">3</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg03.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">4</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg04.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">5</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg05.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">6</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg06.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">7</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg07.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">8</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg08.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">9</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg09.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>
                                </ul>
                                <button class="btn btnlightblue mt-3 d-sm-block d-md-none">Go to rankings</button>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="SellerTabTwo">
                            <div class="topSellers">
                                <ul>
                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">1</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">2</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">3</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">4</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">5</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">6</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">7</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">8</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">9</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/sellerimg01.svg" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="SellerTabThree">
                            <div class="topSellers">
                                <ul>
                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">1</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg01.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">2</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg02.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">3</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg03.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">4</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg04.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">5</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg05.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">6</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg06.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">7</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg07.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">8</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg08.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">9</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg09.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="SellerTabFour">
                            <div class="topSellers">
                                <ul>
                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">1</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg01.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">2</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg02.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">3</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg03.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">4</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg04.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">5</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg05.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">6</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg06.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">7</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg07.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">8</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg08.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>

                                        <div class="seller">
                                            <div class="sellerLeft">
                                                <div class="sellcount">9</div>
                                                <div class="sellerimg">
                                                    <img class="img-fluid" src="img/topsellerimg09.png" alt="img">
                                                    <span class="bluecheckicon"><img src="img/checkicon.svg" alt="img"></span>
                                                </div>
                                                <div class="sellertitlepr">
                                                    <h2>Metasaurs by Dr. DMT</h2>
                                                    <h3><img src="img/priceicon.svg"> 8 921,77</h3>
                                                </div>
                                            </div>
                                            <div class="sellerPrice textbluecolor">+ 69,5%</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
*/?>

    <? /*
<!-- Last Added Items -->
<div class="LastAddedItems mt-5 pt-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="headingWh mb-3 mb-sm-3 mb-md-4 mb-xl-4">Last Added Items</h2>
                <div class="lastAdded slider">
                    <div class="aboutitem">
                        <div class="aboutitemImg"><img class="img-fluid" src="img/last-added-itemimg01.png" alt="img">
                        </div>
                        <div class="bgdarkbluecolor aboutitemcnt">
                            <div class="itemtitlecode">
                                <h2 class="textgraycolor">Cryptosharks</h2>
                                <h3 class="textwhitecolor">Cryptosharks #4939</h3>
                            </div>
                            <div class="itemtitlePrice">
                                <h2 class="textgraycolor">Price</h2>
                                <h3 class="textwhitecolor"><img src="img/priceicon.svg"> <strong>0, 006</strong></h3>
                                <h4 class="textgraycolor"><span><img src="img/hearticon.svg"></span> 56</h4>
                            </div>
                        </div>
                    </div>

                    <div class="aboutitem">
                        <div class="aboutitemImg"><img class="img-fluid" src="img/last-added-itemimg02.png" alt="img">
                        </div>
                        <div class="bgdarkbluecolor aboutitemcnt">
                            <div class="itemtitlecode">
                                <h2 class="textgraycolor">Cryptosharks</h2>
                                <h3 class="textwhitecolor">Cryptosharks #4939</h3>
                            </div>
                            <div class="itemtitlePrice">
                                <h2 class="textgraycolor">Price</h2>
                                <h3 class="textwhitecolor"><img src="img/priceicon.svg"> <strong>0, 006</strong></h3>
                                <h4 class="textgraycolor"><span><img src="img/hearticon-blue.svg"></span> 56</h4>
                            </div>
                        </div>
                    </div>

                    <div class="aboutitem">
                        <div class="aboutitemImg"><img class="img-fluid" src="img/last-added-itemimg03.png" alt="img">
                        </div>
                        <div class="bgdarkbluecolor aboutitemcnt">
                            <div class="itemtitlecode">
                                <h2 class="textgraycolor">Cryptosharks</h2>
                                <h3 class="textwhitecolor">Cryptosharks #4939</h3>
                            </div>
                            <div class="itemtitlePrice">
                                <h2 class="textgraycolor">Price</h2>
                                <h3 class="textwhitecolor"><img src="img/priceicon.svg"> <strong>0, 006</strong></h3>
                                <h4 class="textgraycolor"><span><img src="img/hearticon-blue.svg"></span> 56</h4>
                            </div>
                        </div>
                    </div>

                    <div class="aboutitem">
                        <div class="aboutitemImg"><img class="img-fluid" src="img/last-added-itemimg04.png" alt="img">
                        </div>
                        <div class="bgdarkbluecolor aboutitemcnt">
                            <div class="itemtitlecode">
                                <h2 class="textgraycolor">Cryptosharks</h2>
                                <h3 class="textwhitecolor">Cryptosharks #4939</h3>
                            </div>
                            <div class="itemtitlePrice">
                                <h2 class="textgraycolor">Price</h2>
                                <h3 class="textwhitecolor"><img src="img/priceicon.svg"> <strong>0, 006</strong></h3>
                                <h4 class="textgraycolor"><span><img src="img/hearticon.svg"></span> 56</h4>
                            </div>
                        </div>
                    </div>

                    <div class="aboutitem">
                        <div class="aboutitemImg"><img class="img-fluid" src="img/last-added-itemimg01.png" alt="img">
                        </div>
                        <div class="bgdarkbluecolor aboutitemcnt">
                            <div class="itemtitlecode">
                                <h2 class="textgraycolor">Cryptosharks</h2>
                                <h3 class="textwhitecolor">Cryptosharks #4939</h3>
                            </div>
                            <div class="itemtitlePrice">
                                <h2 class="textgraycolor">Price</h2>
                                <h3 class="textwhitecolor"><img src="img/priceicon.svg"> <strong>0, 006</strong></h3>
                                <h4 class="textgraycolor"><span><img src="img/hearticon-blue.svg"></span> 56</h4>
                            </div>
                        </div>
                    </div>

                    <div class="aboutitem">
                        <div class="aboutitemImg"><img class="img-fluid" src="img/last-added-itemimg02.png" alt="img">
                        </div>
                        <div class="bgdarkbluecolor aboutitemcnt">
                            <div class="itemtitlecode">
                                <h2 class="textgraycolor">Cryptosharks</h2>
                                <h3 class="textwhitecolor">Cryptosharks #4939</h3>
                            </div>
                            <div class="itemtitlePrice">
                                <h2 class="textgraycolor">Price</h2>
                                <h3 class="textwhitecolor"><img src="img/priceicon.svg"> <strong>0, 006</strong></h3>
                                <h4 class="textgraycolor"><span><img src="img/hearticon-blue.svg"></span> 56</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
*/?>

    <!-- Popular -->
    <div class="LastAddedItems mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headingWh mb-3 mb-sm-3 mb-md-4 mb-xl-4">Популярное</h2>
                    <div class="lastAdded slider">
                        @foreach($popularBooks as $book)
                            <a href="{{route('books.detail', ['book' => $book->id])}}">
                                <div class="aboutitem">
                                    <div class="aboutitemImg">
                                        <img class="img-fluid" src="{{asset($book->cover_img)}}" alt="img">
                                    </div>
                                    <div class="bgdarkbluecolor aboutitemcnt">
                                        <div class="itemtitlecode">
                                            <h3 class="textwhitecolor">{{$book->name}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Popular collections -->
    <div class="popularcollections mt-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headingWh mb-4 mb-sm-4 mb-md-4 mb-xl-4">Читай с удовольствием</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="createsell">
                        <div class="createsellHead">
                            <div class="creatsellicon"><img src="img/setupwalleticon.svg" alt="img"></div>
                            <h3 class="textwhitecolor">Экономь</h3>
                        </div>
                        <p class="textgraycolor">С нами не нужно покупать книги!</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="createsell">
                        <div class="createsellHead">
                            <div class="creatsellicon"><img src="img/collectionicon.svg" alt="img"></div>
                            <h3 class="textwhitecolor">Коллекции</h3>
                        </div>
                        <p class="textgraycolor">Создавай свом сборники книг и добавляй в избранное</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="createsell">
                        <div class="createsellHead">
                            <div class="creatsellicon"><img src="img/addyouricon.svg" alt="img"></div>
                            <h3 class="textwhitecolor">Прелестные обложки</h3>
                        </div>
                        <p class="textgraycolor">У нас самые красивые обложки</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="createsell">
                        <div class="createsellHead">
                            <div class="creatsellicon"><img src="img/listthemicon.svg" alt="img"></div>
                            <h3 class="textwhitecolor">Вдохновляющие авторы и богатая библиотека</h3>
                        </div>
                        <p class="textgraycolor">Множество различных авторов. Всемирно известные и мало знакомые</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
