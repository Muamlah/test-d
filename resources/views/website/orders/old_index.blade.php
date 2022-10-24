@extends('website.layout')

@section('content')
    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">الطلبات</h1>
                <p class="color-white mt-n1 mb-0"></p>
            </div>
        </div>
        @if(session()->has('error'))
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white"> {{ session()->get('error') }}</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{ session()->get('success') }}</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        <div class="content">
            <div class="card card-style bg-theme pb-0">
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl"
                     data-tab-items="2" data-tab-active="bg-green-muamlah color-white">
                    <a href="#" data-tab="tab-public_order">طلبات عامة</a>
                    <a href="#" data-tab-active data-tab="tab-e_services">طلبات الخدمات الإلكترونية</a>
                </div>
            </div>
            <div class="clearfix mb-3"></div>

            <div class="tab-content" id="tab-e_services">
                <div class="pt-2">
                    @if(auth()->check())
                        @if($electronic_provider_count >= $setting->electronic_order_provider_limit && ($setting->electronic_order_provider_limit!=0 || $setting->electronic_order_provider_limit!=null)	)
                            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                                <h4 class="text-uppercase color-white">لا يمكنك قبول طلب على  طلبات الخدمات الالكترونية !</h4>
                                <strong class="alert-icon-text">لقد تجاوزت العدد المسموح به من الطلبات اليوم</strong>
                                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
                            </div>
                        @endif
                    @endif
                    <div id="load-section">
                        <div class="card card-style">
                            <div class='container-load loading'>
                                <div class='img-container'>
                                    <div class='img'>
                                    </div>
                                </div>
                                <div class='content-load'>
                                    <div class='stripe small-stripe'>
                                    </div>
                                    <div class='stripe medium-stripe'>
                                    </div>
                                    <div class='stripe long-stripe'>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card card-style">
                            <div class='container-load loading'>
                                <div class='img-container'>
                                    <div class='img'>
                                    </div>
                                </div>
                                <div class='content-load'>
                                    <div class='stripe small-stripe'>
                                    </div>
                                    <div class='stripe medium-stripe'>
                                    </div>
                                    <div class='stripe long-stripe'>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card card-style">
                            <div class='container-load loading'>
                                <div class='img-container'>
                                    <div class='img'>
                                    </div>
                                </div>
                                <div class='content-load'>
                                    <div class='stripe small-stripe'>
                                    </div>
                                    <div class='stripe medium-stripe'>
                                    </div>
                                    <div class='stripe long-stripe'>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card card-style">
                            <div class='container-load loading'>
                                <div class='img-container'>
                                    <div class='img'>
                                    </div>
                                </div>
                                <div class='content-load'>
                                    <div class='stripe small-stripe'>
                                    </div>
                                    <div class='stripe medium-stripe'>
                                    </div>
                                    <div class='stripe long-stripe'>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card card-style">
                            <div class='container-load loading'>
                                <div class='img-container'>
                                    <div class='img'>
                                    </div>
                                </div>
                                <div class='content-load'>
                                    <div class='stripe small-stripe'>
                                    </div>
                                    <div class='stripe medium-stripe'>
                                    </div>
                                    <div class='stripe long-stripe'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(auth()->check())
                        <div id="eservicesOrders">
                            @include('website.orders.ajax-view.eservicesOrders')
                        </div>
                    @else
                        <div id="eservicesOrders">
                            @include('website.orders.ajax-view.eservicesOrdersPublic')
                        </div>
                    @endif

                    <div class="content shadow-l mb-0 ml-0 mr-0">
                        @if($eservices_orders->count()==10)
                            <a data-page="2" data-link="{{route('orders.eservicesSeeMore')}}" data-div="#eservicesOrders" href="#"  class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                المزيد</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-content" id="tab-public_order">
                <div class="pt-2">
                    @if($order_offer_count >= $setting->offers_public_order_limit && ($setting->offers_public_order_limit!=0 || $setting->offers_public_order_limit !=null))
                        <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                            <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                            <h4 class="text-uppercase color-white">لا يمكنك اضافة عرض على  طلبات الخدمات الإلكترونية !</h4>
                            <strong class="alert-icon-text">لقد تجاوزت العدد المسموح به من العروض اليوم</strong>
                            <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
                        </div>
                    @endif
                    @if(auth()->check() && auth()->user()->level == 'user')
                        <div  id="publicOrderUser">
                            @include('website.orders.ajax-view.ordersUser')
                        </div>
                        {{-- <button class="see-more" >See more</button>--}}
                        <div  class="content shadow-l mb-0 ml-0 mr-0">
                            @if($my_orders->count()==10)
                                <a data-page="2" data-link="{{route('orders.userSeeMore')}}" data-div="#publicOrderUser" href="#"  class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                    المزيد</a>
                            @endif
                        </div>
                    @elseif(auth()->check() && auth()->user()->level == 'provider')
                        <div  id="publicOrderProvider">
                            @include('website.orders.ajax-view.ordersProvider')
                        </div>
                        {{-- <button class="see-more" >See more</button>--}}
                        <div  class="content shadow-l mb-0 ml-0 mr-0">
                            @if($orders->count()==10)
                                <a data-page="2" data-link="{{route('orders.providerSeeMore')}}" data-div="#publicOrderProvider" href="#"  class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                    المزيد</a>
                            @endif
                        </div>
                    @else
                    <div  id="publicOrderProvider">
                        @include('website.orders.ajax-view.ordersPublic')
                    </div>
                    <div  class="content shadow-l mb-0 ml-0 mr-0">
                        @if($orders->count()==10)
                            <a data-page="2" data-link="{{route('orders.providerSeeMore')}}" data-div="#publicOrderProvider" href="#"  class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                المزيد</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(window).on('load', function () {
            $('.menu').css('display', 'block');
            setTimeout(function () {
                $('#load-section').addClass('load-hide');
            }, 1500);
            $('#eservicesOrders').addClass('show');
        })
    </script>
    <script>
        $(".see-more").click(function() {

            let div = $($(this).data('div')); //div to append
            let link = $(this).data('link'); //current URL
            let page = $(this).data('page'); //get the next page #
            // alert(page)
            let thisSeeMore =$(this);
            console.log(page);
            let href = link + '?page='+ page; //complete URL
            $.ajax(
                {
                    url:   href,
                    type: "get",
                    beforeSend: function()
                    {
                        thisSeeMore.html('جاري التحميل....');
                    }
                })
                .done(function(data)
                {
                    if(data.html == ""){
                        thisSeeMore.html('لا يوجد المزيد');
                        thisSeeMore.hide();
                        return;
                    }
                    thisSeeMore.data('page',page + 1); //update page #
                    $(data.html).hide().appendTo(div).show(1000);
                    thisSeeMore.html('المزيد');
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('الرجاء المحاولة مرة اخرى');
                });
        });


    </script>

@endsection

