@extends ("layouts/index_layout")

@section('content')

<!-- item-detail -->
<div class="item-detail  mt-2 mt-md-4 pt-3">
    <div class="circlebg3 d-none d-lg-block ">
        <img class="img-fluid" src="{{asset('img/circlebg21.svg')}}" alt="img">
    </div>
    <div class="container mt-3 mt-md-5">
        <h2 class="prev-title d-block d-lg-none pb-4 pb-md-5">{{$book->name}}</h2>
        <div class="row">
            <div class="col-lg-7 pr-80">
                <div class="tab-prev d-block d-md-flex d-lg-block">
                    <div class="item-detail-prev">
                        <img src="{{asset($book->cover_img)}}" class="img-fluid" alt="image">
                    </div>
                    <div class="tab-prev-right d-block d-lg-none">
                        <div class="wishlist d-none d-md-block mb-3">
                            <img src="{{asset('img/wishlist.svg')}}" class="img-fluid" alt="wishlist"> 358
                        </div>
                        <div class="dt-spec mt-3 mt-md-0">
                            <ul class="row d-flex flex-wrap">
                                <li class="col-6 col-sm-6 col-md-12  mb-3 mb-lg-4 mt-lg-2 mt-0">
                                    <label class="mt-3 mt-lg-0 mb-2">Автор</label>
                                    <div class="mentionperson d-flex  align-items-center">
                                        @if($book->author->photo)
                                            <img src="{{asset($book->author->photo)}}" class="img-fluid" alt="image">
                                        @endif
                                        <p><a href="#">{{$book->author->full_name}}</a></p>
                                    </div>
                                </li>
                                <li class="col-6 col-sm-6 col-md-12  mb-3 mb-lg-4 mt-lg-2 mt-0">
                                    <label class="mt-3 mb-2">Издательство</label>
                                    <div class="mentionperson d-flex  align-items-center">
                                        <p><a href="#">{{$book->publisher->name}}</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 pt-0 pt-lg-4">
                <div class="prevItemData d-flex d-md-block flex-wrap">
                    <h2 class="prev-title d-none d-lg-block">{{$book->name}}</h2>
                    <div class=" w-100 dt-spec mt-2 mb-3 m-lg-0 order-2">
                        <ul class="row d-flex flex-wrap">
                            <li class="col-6 d-none d-lg-block  mb-4 mt-2">
                                <label class="mt-3 mb-2">Автор</label>
                                <div class="mentionperson d-flex  align-items-center">
                                    @if($book->author->photo)
                                        <img src="{{asset($book->author->photo)}}" class="img-fluid" alt="image">
                                    @endif
                                    <p><a href="#">{{$book->author->full_name}}</a></p>
                                </div>
                            </li>
                            <li class="col-6 d-none d-lg-block  mb-4 mt-2">
                                <label class="mt-3 mb-2">Издательство</label>
                                <div class="mentionperson d-flex align-items-center">
                                    <p><a href="#">{{$book->publisher->name}}</a></p>
                                </div>
                            </li>
                            <? /*<li class="col-6 mb-4 mt-2">
                                <label class="mt-3 mb-2">Добавлено в избранное</label>
                                <h3 class="textwhitecolor"><img src="img/priceicon.svg"> <strong>0, 006</strong></h3>
                            </li>*/ ?>
                            <li class="col-6 mb-4 mt-2">
                                <label class="mt-3 mb-2">Дата публикации</label>
                                <h4>{{$book->date_publish}}</h4>
                            </li>
                            <li class="col-6 mb-4 mt-2">
                                <label class="mt-3 mb-2">Количество страниц</label>
                                <h4>{{$book->pages_quantity}}</h4>
                            </li>
                            <li class="col-6 mb-4 mt-2">
                                <label class="mt-3 mb-2">Возрастной рейтинг</label>
                                <h4>{{$book->age_rating}}</h4>
                            </li>
                        </ul>
                    </div>
                    <div class="bottombad d-flex flex-wrap align-items-center justify-content-between">
                        <div class="wishlist d-block d-md-none d-lg-block">
                            <img src="{{asset('img/wishlist.svg')}}" class="img-fluid" alt="wishlist"> 358
                        </div>
                    </div>
                    <div class="prev-des">
                        <p><strong>Описание</strong></p>
                        <p>{{$book->description}}</p>
                    </div>
                    <div class=" w-100 prevActions order-3 d-block d-md-flex mb-3 mb-lg-0">
                        <a href="{{asset($book->file)}}">
                            <button class="btn btnlightblue mb-3 mb-md-4 me-0 me-md-4  ">Скачать</button>
                        </a>
                        <button class="btn btndarkblue mb-3 mb-md-4 ">Посмотреть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Last Added Items -->
<div class="LastAddedItems pt-3 pt-md-5 mt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="headingWh mb-3 mb-sm-3 mb-md-4 mb-xl-5">Популярное</h2>
                <div class="lastAdded slider">
                    @foreach($popularBooks as $book)
                        <a href="{{route('books.detail', ['id' => $book->id])}}">
                            <div class="aboutitem">
                                <div class="bgdarkbluecolor aboutitemcnt">
                                    <div class="itemtitlecode">
                                        <h2 class="textgraycolor">{{$book->author->full_name}}</h2>
                                        <h3 class="textwhitecolor">{{$book->name}}</h3>
                                    </div>
                                    <div class="itemtitlePrice">
                                        <h2 class="textgraycolor">{{$book->date_publish}}</h2>
                                        <h3 class="textwhitecolor"><strong>{{$book->age_rating}}</strong></h3>
                                        {{--                                    <h4 class="textgraycolor"><span><img src="img/hearticon.svg"></span> 56</h4>--}}
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

<? /*
<!-- Popular collections -->
<div class="popularCollection mt-4 pt-4 mt-md-5 pt-md-5 mt-lg-5 pt-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="headingWh mb-4">Popular collections</h2>
                <div class="tab-sec">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link d-none d-sm-none d-md-block active" data-bs-toggle="tab" data-bs-target="#TabOne">All categories</button>
                            <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab" data-bs-target="#TabTwo">Digital</button>
                            <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab" data-bs-target="#TabThree">Photography</button>
                            <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab" data-bs-target="#TabFour">Memes</button>
                            <div class="more-tab">
                                <a href="javascript:void(0)" class="textbluecolor categorytab">Choose category <img src="img/bluedown.png" alt="arrow-down"></a>
                                <div class="more-box nav nav-tabs" id="more_tab" role="tablist">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#TabOne">All categories</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#TabTwo">Digital</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#TabThree">Photography</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#TabFour">Memes</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg1">All categories</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg2">Memes</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg3">Photography</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg4">Digital</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg5">News</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg6">Music</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg7">Domain names</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg8">Virtual worlds</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg9">Trading cards</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg10">Sports</button>
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabcatg11">Utility</button>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="TabOne">
                            <div class="popular slider">
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon01.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg02.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon02.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg03.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon03.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon01.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg02.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon02.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg03.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon03.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="TabTwo">
                            <div class="popular slider">
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg03.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon03.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon01.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg02.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon02.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg03.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon03.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon01.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/popularcolimg02.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/popularcolicon02.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="TabThree">
                            <div class="popular slider">
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="TabFour">
                            <div class="popular slider">
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                                <div class="creators">
                                    <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                    <div class="creatorIcon">
                                        <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                        <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                    </div>
                                    <div class="creatorsText text-center">
                                        <h2 class="textwhitecolor">RTFKT Creators</h2>
                                        <h3 class="textbluecolor">by RTFKT</h3>
                                        <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabcatg1">
                            <div class="white-box">
                                <div class="popular slider">
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tabcatg2">
                            <div class="white-box">
                                <div class="popular slider">
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                    <div class="creators">
                                        <div class="creatorImg"><img class="img-fluid" src="img/creatoreimg01.png" alt="img"></div>
                                        <div class="creatorIcon">
                                            <img class="img-fluid" src="img/authoreicon11.png" alt="imig">
                                            <div class="creatorcheck"><img src="img/checkicon.svg" alt="img"></div>
                                        </div>
                                        <div class="creatorsText text-center">
                                            <h2 class="textwhitecolor">RTFKT Creators</h2>
                                            <h3 class="textbluecolor">by RTFKT</h3>
                                            <p class="textgraycolor">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Top sellers -->
<div class="TopsellerSec pt-4 mt-4 pb-4 mt-md-5 pt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headingWh mb-4">Top sellers</h2>
                    <div class="tab-sec">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link d-none d-sm-none d-md-block active" data-bs-toggle="tab" data-bs-target="#SellerTabOne">All</button>
                                <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab" data-bs-target="#SellerTabTwo">24 Hours</button>
                                <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab" data-bs-target="#SellerTabThree">Last week</button>
                                <button class="nav-link d-none d-sm-none d-md-block" data-bs-toggle="tab" data-bs-target="#SellerTabFour">Last month</button>
                                <div class="more-tab d-block d-sm-block d-md-none">
                                    <a href="javascript:void(0)" class="textbluecolor categoryTimeTab">Choose category <img src="img/bluedown.png" alt="arrow-down"></a>
                                    <div class="more-box nav nav-tabs" id="timeTab" role="tablist">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#SellerTabOne">All</button>
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#SellerTabTwo">24 Hours</button>
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#SellerTabThree">Last week</button>
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#SellerTabFour">Last month</button>
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
*/ ?>

@endsection
