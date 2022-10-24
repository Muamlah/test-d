@extends('website.layout')

@section('content')


    <!-- Page Content-->
    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        {{-- <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">طلباتي</h1>
                <p class="color-white mt-n1 mb-0">الطلبات التي قمت بها</p>
            </div>
        </div> --}}
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
        @if (Session::get('hyperpay_success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{Session::get('hyperpay_success')}}</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if (Session::get('hyperpay_error') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <strong>{{Session::get('hyperpay_error')}} </strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        <div class="search-box search-color bg-highlight rounded-s mb-3 card-style">
            <i class="fa fa-search"></i>
            <input style="border: unset" class="search-input" type="text" class="border-0" placeholder="يرجى الكتابة للبحث" data-search>
        </div>
        <div class="card card-style">
            <div class="accordion order-accordion" id="accordion-1">
                <div class="mb-0">
                    <button class="btn accordion-btn" data-toggle="collapse" data data-target="#collapse1"
                            aria-expanded="true">
                        <i class="fa fa fa-box-open"></i>
                        طلباتي
                        <i class="fas fa-sliders-h font-14 accordion-icon"></i>
                    </button>
                    <div id="collapse1" class="collapse border-top" data-parent="#accordion-1" style="">
                        <div class="pt-1 pb-2 pl-3 pr-3">
                            @foreach($order_status as $status)
                                <div class="fac fac-checkbox"><span></span>
                                    <input id="box1-fac-checkbox-{{$status->id}}" class="filter" type="checkbox" value="{{$status->id}}">
                                    <label for="box1-fac-checkbox-{{$status->id}}">{{$status->name}}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-style bg-theme pb-0">
            <div class="content">
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" data-tab-items="2" data-tab-active="bg-green-muamlah color-white">
                    <a href="#" data-tab="tab-my-orders">طلباتي</a>
                    <a href="#" data-tab-active data-tab="tab-market-order">طلبات السوق</a>
                    {{-- <a class="orders-tabs" href="#" data-tab="tab-my-service">خدماتي</a> --}}
                </div>
                <div class="clearfix mb-3"></div>
                {{-- <div class="tab-content" id="tab-my-service">
                    <div class="pt-2">
                        <div id="myService">
                        </div>
                        <div  class="content shadow-l mb-0 ml-0 mr-0">
                            <a data-page="1" data-link="{{route('publicOrders.seeMoreMyService')}}" data-div="#myService" href="#"  class="see-more-my-service btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                المزيد
                            </a>
                        </div>
                    </div>
                </div> --}}
                <div class="tab-content" id="tab-market-order">
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
                        <div id="marketOrders">
                            {{-- @include('website.eservices_orders.ajax-view.data') --}}
                        </div>
                        <div class="content shadow-l mb-0 ml-0 mr-0">
                            <a data-page="1" data-link="{{route('publicOrders.seeMoreMarket')}}" data-div="#marketOrders" href="#"  class="see-more-market btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                المزيد
                            </a>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="tab-my-orders">
                    <div class="pt-2">
                        <div id="publicOrder">
                            {{-- @include('website.orders.ajax-view.data') --}}
                        </div>
                        <div  class="content shadow-l mb-0 ml-0 mr-0">
                            <a data-page="1" data-link="{{route('publicOrders.seeMore')}}" data-div="#publicOrder" href="#"  class="see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                المزيد
                            </a>
                        </div>
                    </div>
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
            $('#marketOrders').addClass('show');
        })
    </script>
    <script>
        var input_val = null;
        $(".search-input").keyup(function() {
            input_val = this.value;
            $('#publicOrder').html('');
            $('#marketOrders').html('');
            // $('#myService').html('');

            $(".see-more").data('page', 1);
            $(".see-more").click();
            $(".see-more-market").data('page', 1);
            $(".see-more-market").click();
            // $(".see-more-my-service").data('page', 1);
            // $(".see-more-my-service").click();
        });

        $(".see-more").click(function() {
            var filter = [];
            $('.filter:checked').each(function () {
                filter.push(this.value);
            });
            let div = $($(this).data('div')); //div to append
            let link = $(this).data('link'); //current URL
            let page = $(this).data('page'); //get the next page #
            // alert(page)
            let thisSeeMore =$(this);
            let href = link + '?page='+ page; //complete URL
            $.ajax(
                {
                    url:   href,
                    type: "get",
                    data: {
                        filter:filter,input_val:input_val
                    },
                    beforeSend: function()
                    {
                        thisSeeMore.html('جاري التحميل....');
                    }
                })
                .done(function(data)
                {
                    if(data.html == ""){
                        thisSeeMore.html('لا يوجد المزيد');
                        setTimeout(function(){
                            thisSeeMore.hide();
                        },1000);
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
        $(".see-more-market").click(function() {
            var filter = [];
            $('.filter:checked').each(function () {
                filter.push(this.value);
            });
            let div = $($(this).data('div')); //div to append
            let link = $(this).data('link'); //current URL
            let page = $(this).data('page'); //get the next page #
            // alert(page)
            let thisSeeMore =$(this);
            let href = link + '?page='+ page; //complete URL
            $.ajax(
                {
                    url:   href,
                    type: "get",
                    data: {
                        filter:filter,input_val:input_val
                    },
                    beforeSend: function()
                    {
                        thisSeeMore.html('جاري التحميل....');
                    }
                })
                .done(function(data)
                {
                    if(data.html == ""){
                        thisSeeMore.html('لا يوجد المزيد');
                        setTimeout(function(){
                            thisSeeMore.hide();
                        },1000);
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
        $(".see-more-my-service").click(function() {
            var filter = [];
            $('.filter:checked').each(function () {
                filter.push(this.value);
            });
            let div = $($(this).data('div')); //div to append
            let link = $(this).data('link'); //current URL
            let page = $(this).data('page'); //get the next page #
            // alert(page)
            let thisSeeMore =$(this);

            let href = link + '?page='+ page; //complete URL
            $.ajax(
                {
                    url:   href,
                    type: "get",
                    data: {
                        filter:filter,input_val:input_val
                    },
                    beforeSend: function()
                    {
                        thisSeeMore.html('جاري التحميل....');
                    }
                })
                .done(function(data)
                {
                    if(data.html == ""){
                        thisSeeMore.html('لا يوجد المزيد');
                        setTimeout(function(){
                            thisSeeMore.hide();
                        },1000);
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

        $('.filter').change(function(){
            $('.filter').prop("disabled", true);
            setTimeout(function(){
                $('.filter').prop("disabled", false);
            },2000);
            // $('#privateOrder').html('');
            $('#publicOrder').html('');
            $('#marketOrders').html('');
            // $('#myService').html('');

            $(".see-more").data('page', 1);
            $(".see-more").click();
            $(".see-more-market").data('page', 1);
            $(".see-more-market").click();
            // $(".see-more-my-service").data('page', 1);
            // $(".see-more-my-service").click();

        });

        $(".see-more").click();
        $(".see-more-market").click();
        // $(".see-more-my-service").click();


    </script>

@endsection
