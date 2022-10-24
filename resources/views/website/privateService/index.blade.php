@extends('website.layout')

@section('content')


    <!-- Page Content-->
    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">خدماتي</h1>
                <p class="color-white mt-n1 mb-0"></p>
            </div>
        </div>
        <div class="card card-style">
            <div class="accordion order-accordion" id="accordion-1">
                <div class="mb-0">
                    <button class="btn accordion-btn" data-toggle="collapse" data data-target="#collapse1"
                            aria-expanded="true">
                        <i class="fa fa fa-box-open"></i>
                        خدماتي
                        <i class="fas fa-sliders-h font-14 accordion-icon"></i>
                    </button>
                    <div id="collapse1" class="collapse border-top" data-parent="#accordion-1" style="">
                        <div class="pt-1 pb-2 pl-3 pr-3">
                            <div class="fac fac-checkbox"><span></span>
                                <input id="box1-fac-checkbox" type="checkbox" value="0">
                                <label for="box1-fac-checkbox">بإنتظار المراجعة</label>
                            </div>
                            <div class="fac fac-checkbox"><span></span>
                                <input id="box2-fac-checkbox" type="checkbox" value="0">
                                <label for="box2-fac-checkbox">بإنتظار التنفيد</label>
                            </div>
                            <div class="fac fac-checkbox"><span></span>
                                <input id="box3-fac-checkbox" type="checkbox" value="0">
                                <label for="box3-fac-checkbox">بإنتظار التسليم</label>
                            </div>
                            <div class="fac fac-checkbox"><span></span>
                                <input id="box4-fac-checkbox" type="checkbox" value="0">
                                <label for="box4-fac-checkbox">تم التسليم</label>
                            </div>
                            <div class="fac fac-checkbox"><span></span>
                                <input id="box5-fac-checkbox" type="checkbox" value="0">
                                <label for="box5-fac-checkbox">ملغي</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-style bg-theme pb-0">
            <div class="content">
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl"
                     data-tab-items="2" data-tab-active="bg-green-muamlah color-white">
                    {{-- <a href="#" data-tab="tab-orders-private">التعميد الخاص</a> --}}
                    <a href="#" data-tab="tab-orders-public">طلبات التعميد</a>
                    <a href="#" data-tab-active data-tab="tab-eservices">الخدمات الإلكترونية</a>
                </div>
                <div class="clearfix mb-3"></div>


                <div class="tab-content" id="tab-eservices">
                    <div class="pt-2">
                        <div id="eservicesService">
                            @include('website.privateService.ajax-view.eservices_data')
                        </div>

                        <div class="content shadow-l mb-0 ml-0 mr-0">
                            @if($publicOrders->count()==10)
                                <a data-page="2" data-link="{{route('eServices.providerSeeMore')}}" data-div="#eservicesService" href="#"  class="see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                    المزيد</a>
                            @endif
                        </div>
                    </div>
                </div>


                {{-- <div class="tab-content" id="tab-orders-private">
                    <div class="pt-2">
                        <div  id="privateService">
                            @include('website.privateService.ajax-view.data')
                        </div>
                        <div  class="content shadow-l mb-0 ml-0 mr-0">
                            @if($items->count()==10)
                                <a data-page="2" data-link="{{route('privateService.seeMore')}}" data-div="#privateService" href="#"  class="see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                    المزيد</a>
                            @endif
                        </div>
                    </div>
                </div> --}}



                <div class="tab-content" id="tab-orders-public">

                    <div class="pt-2">
                        <div  id="publicService">
                        </div>
                        <div  class="content shadow-l mb-0 ml-0 mr-0">
                            <a data-page="1" id="more" data-link="{{route('privateService.seeMore')}}"
                                data-div="#publicService" href="#"  class="see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                المزيد</a>
                        </div>


                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection
@section('script')
    <script>
        $(".see-more").click(function() {
            let div = $($(this).data('div')); //div to append
            let link = $(this).data('link'); //current URL
            let page = $(this).data('page'); //get the next page #
            let thisSeeMore =$(this);
            // console.log(page);
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
                        thisSeeMore.html('لا يوجد المزيد من خدمات');
                        thisSeeMore.hide(1000);
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
        $("#more").click();
    </script>

@endsection
