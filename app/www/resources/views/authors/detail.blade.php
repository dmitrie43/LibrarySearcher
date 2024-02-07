@extends ("layouts/index_layout")

@section('content')

    <!-- item-detail -->
    <div class="item-detail  mt-2 mt-md-4 pt-3">
        <div class="circlebg3 d-none d-lg-block ">
            <img class="img-fluid" src="{{asset('img/circlebg21.svg')}}" alt="img">
        </div>
        <div class="container mt-3 mt-md-5">
            <h2 class="prev-title d-block d-lg-none pb-4 pb-md-5">{{$author->full_name}}</h2>
            <div class="row">
                <div class="col-lg-7 pr-80">
                    <div class="tab-prev d-block d-md-flex d-lg-block">
                        <div class="item-detail-prev">
                            <img src="{{isset($author->photo) ? asset($author->photo) : asset('img/author_default.png')}}" class="img-fluid" alt="image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 pt-0 pt-lg-4">
                    <div class="prevItemData d-flex d-md-block flex-wrap">
                        <h2 class="prev-title d-none d-lg-block">{{$author->full_name}}</h2>
                        <div class=" w-100 dt-spec mt-2 mb-3 m-lg-0 order-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
