@extends('website.layout')

@section('content')

    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">الخدمات الإلكترونية</h1>
                <p class="color-white mt-1 mb-0">إختر الجهة ثم أطلب الخدمة المناسبة</p>
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

        @if($electronic_user_count >= $setting->electronic_order_limit)
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">لا يمكنك  طلب خدمة الكترونية !</h4>
                <strong class="alert-icon-text">لقد تجاوزت العدد المسموح به من الطلبات اليوم</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
            {{-- {{dd(Route::currentRouteName())}} --}}
        <div class="search-box search-header bg-theme card-style mr-3 ml-3">
            {{-- <form action="{{route('weblist')}}" method="GET"> --}}
            <button type="submit" class="search-btn" style="position: absolute; border: transparent;"><i class="fa fa-search"></i></button>
            <input name="q" type="text" class="border-0" placeholder="البحث عن الخدمات " style="padding-right: 55px;" data-search="" id="keyword"
            value="" onkeyup="getSearchData();">
            <a href="#" class="disabled"><i class="fa fa-times-circle color-red2-dark"></i></a>
            {{-- </form> --}}
        </div>

        <div class="f-slider owl-carousel owl-no-dots owl-rtl owl-loaded owl-drag">
            @foreach($sections as $r)
                <div class="card card-style card-services text-center">
                    <a href="{{url('section'.'/'.$r->id)}}" class="link-cover">
                    <img class="m-auto" src="{{asset('storage').'/'.$r->img}}" alt="" width="110" height="110" >
                        <h2 class="text-center font-16 font-900 mt-2">
                            {{$r->name}}
                        </h2>
                    </a>
                </div>
            @endforeach
        </div>
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
        <div id="my_eservices">
            @include('website.eservices.ajax-view.data')
        </div>

        <div class="content shadow-l mb-0 ml-0 mr-0">
            <a data-page="1" data-link="{{route('eServices.seeMore')}}" data-div="#my_eservices" href="#"
                class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                المزيد
            </a>
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
            $('#my_eservices').addClass('show');
        })


        function userRate(service_id){

            var token           = "{{ csrf_token() }}";
            @guest
            var provider_id     = 0;
            @else
            var provider_id     = "{{auth()->user()->id}}";

            @endguest
            var type            = $(`.favorit-type${service_id}`).val();
            $.ajax({
                url:   "{{route('eserviceFavorite')}}",
                data: {
                    _token:token , service_id: service_id , provider_id: provider_id , type: type
                },
                type: "post",
                beforeSend: function()
                {

                }
            })
            .done(function(data){
                console.log(data.type);
                if(data.type == 'added_to_favorite'){
                    $(`.favorit-type${service_id}`).val('delete');
                    $(`.interested-service-${service_id}`).css('background-color', '').css('background-color','#DA4453');
                    $(`.interested-service-${service_id}`).html('الغاء الاهتمام');


                    alert('تمت الإضافة إلى المفضلة');
                }else{
                    $(`.favorit-type${service_id}`).val('add');
                    $(`.interested-service-${service_id}`).css('background-color', '').css('background-color','#258206');
                    $(`.interested-service-${service_id}`).html('مهتم');
                    alert('تم الحذف من المفضلة');
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError){
                alert('الرجاء المحاولة مرة اخرى');
            });
        }

    </script>
    <script>
        var lockTyping = false;
        function getData(){
            let div = $($(".see-more").data('div')); //div to append
            let link = $(".see-more").data('link'); //current URL
            let page = $(".see-more").data('page'); //get the next page #
            let keyword = $("#keyword").val(); //get keyword #
            let thisSeeMore =$(".see-more");
            let href = link + '?page='+ page; //complete URL
            $.ajax({
                url:   href,
                data: {
                    keyword: keyword
                },
                type: "get",
                beforeSend: function()
                {
                    thisSeeMore.html('جاري التحميل....');
                }
            })
            .done(function(data){
                if(data.html == ""){
                    thisSeeMore.html('لا يوجد المزيد');
                    thisSeeMore.hide(1000);
                    return;
                }
                thisSeeMore.data('page',page + 1); //update page #
                $(data.html).hide().appendTo(div).show(1000);
                thisSeeMore.html('المزيد');
            })
            .fail(function(jqXHR, ajaxOptions, thrownError){
                alert('الرجاء المحاولة مرة اخرى');
            });
        }
        $(".see-more").click(function() {
            getData();
        });
        $(".see-more").click();
        function getSearchData(){
            setTimeout(function(){
                $(".see-more").show(1000);
                $($(".see-more").data('div')).html('');
                $(".see-more").data('page', 1);
                getData();
            },1000);
        }

    </script>
@endsection

