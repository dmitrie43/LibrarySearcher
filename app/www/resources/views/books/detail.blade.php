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
                    @if($book->file && \Illuminate\Support\Facades\Auth::check())
                        <div class=" w-100 prevActions order-3 d-block d-md-flex mb-3 mb-lg-0">
                            <a href="{{asset($book->file)}}">
                                <button class="btn btnlightblue mb-3 mb-md-4 me-0 me-md-4 ">Скачать</button>
                            </a>
                        </div>
                    @endif
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
                    @foreach($popularBooks as $popularBook)
                        <a href="{{route('books.detail', ['book' => $popularBook->id])}}">
                            <div class="aboutitem">
                                <div class="bgdarkbluecolor aboutitemcnt">
                                    <div class="itemtitlecode">
                                        <h2 class="textgraycolor">{{$popularBook->author->full_name}}</h2>
                                        <h3 class="textwhitecolor">{{$popularBook->name}}</h3>
                                    </div>
                                    <div class="itemtitlePrice">
                                        <h2 class="textgraycolor">{{$popularBook->date_publish}}</h2>
                                        <h3 class="textwhitecolor"><strong>{{$popularBook->age_rating}}</strong></h3>
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

<!-- Comments -->
@if($reviews->isNotEmpty())
    <div class="LastAddedItems pt-3 pt-md-5 mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="headingWh mb-3 mb-sm-3 mb-md-4 mb-xl-5">Отзывы</h2>
                    <div class="lastAdded slider">
                        @foreach($reviews as $review)
                            <div class="aboutitem">
                                <div class="bgdarkbluecolor aboutitemcnt">
                                    <div class="itemtitlecode">
                                        <h2 class="textgraycolor">{{$review->user->name}}</h2>
                                        <h3 class="textwhitecolor">{{$review->theme}}</h3>
                                    </div>
                                    <div class="itemtitlePrice">
                                        <h2 class="textgraycolor">{{$review->is_recommended ? 'Рекомендую' : 'Не рекомендую'}}</h2>
                                        <h3 class="textwhitecolor"><strong>{{date('d.m.Y', strtotime($review->created_at))}}</strong></h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    <a href="{{route('comments.books.index', ['book' => $book->id])}}" class="link-light">
                        <span class="mb-3 mb-xl-5">Посмотреть все</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- write review -->
@if(\Illuminate\Support\Facades\Auth::check())
<div class="contactsec">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="sign-from contact-form">
                    <h2 class="textwhitecolor contact-head">Оставить отзыв</h2>
                    <form method="post" action="{{route('comments.set_review', ['type' => 'books'])}}">
                        @csrf
                        <input type="hidden" name="item_id" value="{{$book->id}}">
                        @if($errors->has('theme'))
                            <span class="alert-danger">{{$errors->first('theme')}}</span>
                        @endif
                        <div class="input-box">
                            <input type="text" name="theme" placeholder="Тема" class="form-input">
                        </div>
                        @if($errors->has('text'))
                            <span class="alert-danger">{{$errors->first('text')}}</span>
                        @endif
                        <div class="input-box">
                            <textarea class="form-input" name="text" placeholder="Отзыв"></textarea>
                        </div>
                        <div class="input-box">
                            <label for="recommended"><span class="textwhitecolor">Рекомендую</span></label>
                            <input id="recommended" type="checkbox" name="is_recommended" class="form-check-input" value="1">
                        </div>
                        <div class="contact-submit">
                            <button class="btn btnlightblue">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="about-crypton">
                    <h2 class="textwhitecolor contact-head"><span class="textbluecolor">libSearcher</span></h2>
                    <p>Отзыв появится на странице после проверки модератором</p>
                    <div class="contact-details">
                        <ul>
                            <li>
                                <a href="#" class="textwhitecolor">
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0131 12.7985C9.8917 12.7981 9.77064 12.7848 9.65203 12.7588C7.39387 12.2916 5.3135 11.1964 3.65037 9.59903C2.02272 7.99819 0.893857 5.95997 0.400365 3.73098C0.342176 3.45318 0.356458 3.16508 0.441837 2.89439C0.527215 2.62371 0.680817 2.37956 0.887865 2.18542L2.33231 0.795142C2.40609 0.725371 2.49375 0.671942 2.58957 0.638341C2.68539 0.604741 2.78723 0.591725 2.88842 0.600142C2.99335 0.611088 3.0946 0.644888 3.18506 0.699165C3.27552 0.753442 3.353 0.826878 3.41203 0.914309L5.21759 3.58292C5.2853 3.68647 5.31798 3.80901 5.31083 3.93252C5.30368 4.05604 5.25707 4.17399 5.17787 4.26903L4.27148 5.35236C4.63246 6.1513 5.14368 6.87339 5.77731 7.47931C6.40683 8.10721 7.15092 8.60857 7.96925 8.95625L9.09231 8.06431C9.18664 7.98976 9.30141 7.94569 9.42139 7.93795C9.54136 7.93021 9.66086 7.95917 9.76398 8.02098L12.4904 9.7832C12.5839 9.83906 12.6636 9.91537 12.7235 10.0064C12.7834 10.0975 12.8219 10.2009 12.8361 10.3089C12.8504 10.4169 12.84 10.5268 12.8058 10.6302C12.7715 10.7337 12.7143 10.8281 12.6384 10.9063L11.2301 12.3001C11.0701 12.4593 10.8802 12.5853 10.6714 12.6708C10.4625 12.7564 10.2388 12.7997 10.0131 12.7985ZM2.83064 1.31514L1.3862 2.70542C1.26972 2.81395 1.1835 2.95093 1.13602 3.10289C1.08853 3.25485 1.08141 3.41655 1.11537 3.57209C1.57424 5.66369 2.62904 7.57764 4.15231 9.08264C5.71744 10.5854 7.67517 11.6156 9.80009 12.0546C9.96093 12.0882 10.1276 12.0814 10.2852 12.0348C10.4427 11.9881 10.5862 11.9031 10.7029 11.7874L12.1112 10.3935L9.4787 8.69264L8.27259 9.6532C8.22641 9.68974 8.172 9.71444 8.1141 9.72514C8.05619 9.73584 7.99655 9.73222 7.94037 9.71459C6.9389 9.3456 6.03134 8.75988 5.28259 7.99931C4.50813 7.27608 3.90698 6.38731 3.52398 5.39931C3.50777 5.3395 3.50723 5.27652 3.52241 5.21644C3.53759 5.15636 3.56798 5.10119 3.61064 5.05625L4.58564 3.88986L2.83064 1.31514Z" fill="white"/>
                                    </svg>
                                    Телефон
                                </a>
                            </li>
                            <li>
                                <a href="#" class="textwhitecolor">
                                    <svg width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.625 0C11.1223 0 11.5992 0.197544 11.9508 0.549175C12.3025 0.900805 12.5 1.37772 12.5 1.875V7.875C12.5 8.37228 12.3025 8.84919 11.9508 9.20082C11.5992 9.55246 11.1223 9.75 10.625 9.75H2.375C1.87772 9.75 1.40081 9.55246 1.04917 9.20082C0.697544 8.84919 0.5 8.37228 0.5 7.875V1.875C0.5 1.37772 0.697544 0.900805 1.04917 0.549175C1.40081 0.197544 1.87772 0 2.375 0H10.625ZM11.75 2.97075L6.6905 5.94825C6.64267 5.97633 6.5892 5.99346 6.53395 5.99839C6.4787 6.00331 6.42305 5.99592 6.371 5.97675L6.3095 5.94825L1.25 2.97225V7.875C1.25 8.17337 1.36853 8.45952 1.5795 8.6705C1.79048 8.88147 2.07663 9 2.375 9H10.625C10.9234 9 11.2095 8.88147 11.4205 8.6705C11.6315 8.45952 11.75 8.17337 11.75 7.875V2.97075ZM10.625 0.75H2.375C2.07663 0.75 1.79048 0.868526 1.5795 1.0795C1.36853 1.29048 1.25 1.57663 1.25 1.875V2.1015L6.5 5.19L11.75 2.1V1.875C11.75 1.57663 11.6315 1.29048 11.4205 1.0795C11.2095 0.868526 10.9234 0.75 10.625 0.75Z" fill="white"/>
                                    </svg>
                                    dmitrie434@mail.ru
                                </a>
                            </li>
                            <li>
                                <a href="#" class="textwhitecolor">
                                    <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.5 0C8.53769 0 11 2.39526 11 5.35023C11 7.61105 9.36692 10.0749 6.14308 12.7681C5.96382 12.9179 5.73526 13.0002 5.49894 13C5.26262 12.9998 5.03422 12.9171 4.85523 12.767L4.642 12.587C1.56087 9.96406 0 7.56057 0 5.35023C0 2.39526 2.46231 0 5.5 0ZM5.5 0.823113C4.26572 0.823113 3.082 1.30008 2.20923 2.14908C1.33647 2.99808 0.846154 4.14957 0.846154 5.35023C0.846154 7.27193 2.28349 9.4861 5.19764 11.9664L5.40805 12.1437C5.43364 12.1651 5.46626 12.1768 5.5 12.1768C5.53374 12.1768 5.56637 12.1651 5.59195 12.1437C8.64713 9.59091 10.1538 7.31748 10.1538 5.35023C10.1538 4.75572 10.0335 4.16704 9.79959 3.61778C9.56572 3.06853 9.22292 2.56946 8.79077 2.14908C8.35862 1.72869 7.84558 1.39523 7.28095 1.16772C6.71632 0.940211 6.11115 0.823113 5.5 0.823113ZM5.5 3.29245C6.06104 3.29245 6.59909 3.50925 6.9958 3.89516C7.39252 4.28107 7.61539 4.80448 7.61539 5.35023C7.61539 5.89599 7.39252 6.4194 6.9958 6.80531C6.59909 7.19122 6.06104 7.40802 5.5 7.40802C4.93897 7.40802 4.40091 7.19122 4.0042 6.80531C3.60749 6.4194 3.38462 5.89599 3.38462 5.35023C3.38462 4.80448 3.60749 4.28107 4.0042 3.89516C4.40091 3.50925 4.93897 3.29245 5.5 3.29245ZM5.5 4.11557C5.16338 4.11557 4.84055 4.24565 4.60252 4.47719C4.36449 4.70874 4.23077 5.02278 4.23077 5.35023C4.23077 5.67769 4.36449 5.99173 4.60252 6.22328C4.84055 6.45482 5.16338 6.5849 5.5 6.5849C5.83662 6.5849 6.15945 6.45482 6.39748 6.22328C6.63551 5.99173 6.76923 5.67769 6.76923 5.35023C6.76923 5.02278 6.63551 4.70874 6.39748 4.47719C6.15945 4.24565 5.83662 4.11557 5.5 4.11557Z" fill="white"/>
                                    </svg>
                                    Адрес
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

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
