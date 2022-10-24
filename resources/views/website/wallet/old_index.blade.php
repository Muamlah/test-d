@extends('website.layout')
@section('content')

    <!-- Page Content-->
    <div class="page-content header-clear-medium">

        @if ($message = Session::get('error') )
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">{{$message}} !</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
            @if($message = Session::get('success'))
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <h4 class="text-uppercase color-white">{{$message}} !</h4>
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endif
        <div data-card-height="230" class="card card-style rounded-m shadow-xl">
            <div class="card-top mt-4 mr-3">
                <h1 class="color-white mb-0 mb-n2">{{Auth::user()->name}}</h1>
            </div>
            <div class="card-top mt-4 ml-3" style="z-index: 99999">
                <a href="#" data-menu="menu-deposit"
                   class="mt-1 float-left text-uppercase font-900 font-11 btn btn-s rounded-s shadow-l bg-highlight">
                    سحب الرصيد
                </a>
            </div>
            <div class="card-bottom text-center">
                <div class="row p-1 mb-0">
                    <div class="col-12">
                        <h1 class="color-white font-24">
                            {{Auth::user()->total_balance }}<span class="font-18">ريال</span>
                        </h1>
                        <p class="color-white opacity-70 font-11">الرصيد الكلي</p>
                    </div>
                    <div class="col-6">
                        <h1 class="color-white font-24">
                            {{Auth::user()->pinding_balance}} <span class="font-18">ريال</span>
                        </h1>
                        <p class="color-white opacity-70 font-11">رصيد الطلبات</p>
                    </div>
                    <div class="col-6">
                        <h1 class="color-white font-24">
                            {{Auth::user()->available_balance}} <span class="font-18">ريال</span>
                        </h1>
                        <p class="color-white opacity-70 font-11">الرصيد المتاح</p>
                    </div>
                </div>
            </div>
            <div class="card-overlay bg-black opacity-70"></div>
            <div class="card-overlay bg-gradient bg-gradient-dark3 opacity-80"></div>
        </div>
{{--        <div class="card card-style bg-theme p-3">--}}
{{--            @if (Session::get('gift_error') )--}}
{{--            <div class=" alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">--}}
{{--                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>--}}
{{--                <strong>{{Session::get('gift_error')}} </strong>--}}
{{--                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>--}}
{{--            </div>--}}
{{--            @endif--}}
{{--            @if ($message = Session::get('gift_success') )--}}
{{--                <div class=" alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">--}}
{{--                    <span><i class="fa fa-check"></i></span>--}}
{{--                    <strong>تم شحن الرصيد بنجاح !</strong>--}}
{{--                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <form method="post" action="{{route('user.use_gift')}}" enctype="multipart/form-data" class="row mb-0 form-horizontal" role="form">--}}
{{--                {{ csrf_field() }}--}}
{{--                <div class="input-style input-style-2 has-icon input-required col-lg-8 col-md-8 mb-0">--}}
{{--                    <span class="color-highlight">كود بطاقة شحن رصيد</span>--}}
{{--                    <input class="form-control order-price mb-0" type="text" required name="code" placeholder="">--}}
{{--                </div>--}}
{{--                <div class="col-md-4 col-lg-4">--}}
{{--                    <button type="submit" class="btn btn-m w-100 btn-full bg-green-c mr-auto ml-auto  text send-order" style="font-size: 16px !important;--}}
{{--                    border-radius: 10px;">--}}
{{--                        شحن رصيد--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
        <div class="card card-style bg-theme pb-0">
            <div class="content content-full">
                <div class="tab-controls tabs-round tab-animated tabs-medium shadow-xl" data-tab-items="3"
                     data-tab-active="bg-highlight color-white">
                    <a href="#" data-tab-active data-tab="tab-overview">سجل الحركة</a>
                    <a href="#" data-tab="tab-invoice">الفواتير</a>
                    <a href="#" data-tab="tab-account">الحساب البنكي</a>
                </div>
                <div class="clearfix mb-3"></div>
            </div>
            <div class="tab-content" id="tab-overview">
                {{--  <div class="row text-center mb-0 mt-3">
                    <a href="#" class="col-6 pl-0">
                        <div class="card card-style ml-2 mb-3">
                            <i class="fa fa-arrow-up color-red2-dark fa-2x mt-3"></i>
                            <h1 class="pt-2 font-18">{{@$sumWithdrawal}} <span class="font-12">ريال</span></h1>
                            <p class="font-11 opacity-50 mt-n2 mb-3">سحب</p>
                        </div>
                    </a>
                    <a href="#" class="col-6 pr-0">
                        <div class="card card-style mr-2 mb-3">
                            <i class="fa fa-arrow-down color-highlight fa-2x mt-3"></i>
                            <h1 class="pt-2 font-18">{{@$sumDeposit}} <span class="font-12">ريال</span></h1>
                            <p class="font-11 opacity-50 mt-n2 mb-3">ايداع</p>
                        </div>
                    </a>
                </div>  --}}
                <div class="card card-style">
                    <div class="content mb-0">
                        <div id="charts-area"></div>
                    </div>
                </div>
                <div class="card card-style">
                    <div class="content mb-0">
                        {{-- <div class="row mb-3">
                            <div class="col-6">
                                <div class="input-style input-style-1 input-required">
                                    <h5 class="font-700 font-11 opacity-50 text-uppercase mb-n3">نوع المعاملات
                                        المالية :</h5>
                                    <em><i class="fa fa-angle-down"></i></em>
                                    <select class="font-11">
                                        <option value="1" selected>جميع المعاملات المالية</option>
                                        <option value="2">الرصيد المرسل</option>
                                        <option value="3">الرصيد المستلم</option>
                                        <option value="4">الرصيد المدفوع</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-style input-style-1 input-required">
                                    <h5 class="font-700 font-11 opacity-50 text-uppercase mb-n3">صنف حسب :</h5>
                                    <em><i class="fa fa-angle-down"></i></em>
                                    <select class="font-11">
                                        <option value="1" selected>كل الحركات المالية</option>
                                        <option value="2">الطلبات</option>
                                        <option value="2">الخدمات</option>
                                        <option value="2">الرصيد القابل للسحب</option>
                                    </select>
                                </div>
                            </div>
                        </div> --}}

                        <div  id="transactions">
                            @include('website.wallet.ajax-view.transactions')
                        </div>

                        <div class="divider mb-2 mt-n2"></div>
                        <div class="content shadow-l mb-0">
                            @if($items->count()==10)
                                <a data-page="2" data-link="{{route('user.seeMoreTransactions')}}"
                                   data-div="#transactions" href="#"
                                   class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                                    المزيد</a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>


            <div class="tab-content" id="tab-invoice">
                <div class="card card-style">
                    <div class="search-box border-0 search-header bg-theme">
                        <form action="" method="POST">
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                            <input type="text" class="border-0"
                                   placeholder="البحث عن الفواتير بواسطة عنوان الطلب أو رقم الطلب">
                        </form>
                    </div>
                </div>

                <div  id="bills">
                    @include('website.wallet.ajax-view.bills')
                </div>

                <div class="divider mb-2 mr-3 ml-3 mt-4"></div>
                <div class="content shadow-l mb-0">
                    @if($invoices->count()>5)
                        <a data-page="2" data-link="{{route('user.seeMoreBills')}}"
                           data-div="#bills" href="#"
                           class="see-more btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                            المزيد</a>
                    @endif
                </div>

            </div>

            <div class="tab-content" id="tab-account">
                <div class="content mb-2">
                    <h2 class="mb-4">بيانات الحساب البنكي</h2>
                        <form method="post" action="{{route('user.updateCreditCard')}}"
                              enctype="multipart/form-data" class="form-horizontal" role="form">
                            {{ csrf_field() }}
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="input-icon fa fa-user"></i>
                            <span class="color-highlight input-style-1-active">الإسم الشخصي كاملاً</span>

                            <em>(مطلوب)</em>
                            <input type="text"  value="{{@$user->creditCard->name?? ''}}"   name="name" required class="form-control">

                        </div>

                        <div class="input-style input-style-2 has-icon input-required mt-4">
                            <i class="input-icon fa fa-university"></i>
                            <span class="color-highlight input-style-1-active">البنك</span>
                            <em>(مطلوب)</em>
                            <input type="text" value="{{@$user->creditCard->bank_name??'' }}" name="bank_name" required class="form-control">
                        </div>
                            <div class="input-style input-style-2 has-icon input-required mt-4">
                            <i class="input-icon fa fa-university"></i>
                            <span class="color-highlight input-style-1-active">رقم الحساب</span>
                            <em>(مطلوب)</em>
                            <input type="text" value="{{@$user->creditCard->number??'' }}" name="number" required class="form-control">
                        </div>
                        <div class="input-style input-style-2 has-icon input-required mt-4">
                            <i class="input-icon fa fa-money-check"></i>
                            <span class="color-highlight input-style-1-active">كود الإيبان (IBAN CODE)</span>
                            <em>(مطلوب)</em>
                            <input  value="{{@$user->creditCard->account_number?? ''}}" name="account_number" required type="text" class="form-control">
                        </div>
                        <button type="submit"
                            class="btn btn-full w-100 bg-green-c btn-m text-uppercase rounded-l shadow-l mb-3 mt-4 font-900">حفظ</button>
                    </form>
                </div>

            </div>

        </div>
        <div id="menu-deposit" class="menu menu-box-modal rounded-m"
                data-menu-height="180"
                data-menu-width="310">
            <div class="mr-3 ml-3 mt-3">
                <h1 class="text-uppercase font-900 mb-0">ادخل قيمة المبلغ المراد سحبه</h1>
                <div class="lineBorder"></div>
                <br>
                <form method="post" action="{{route('user.withdrawal')}}"
                        enctype="multipart/form-data" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-money font-11"></i>
                        <input type="text" name="amount" placeholder="المبلغ" required>
                    </div>
                    <button type="submit" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green1-dark mt-4">تم</button>
                </form>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script type="text/javascript" src="{{asset("/template-muamlah/scripts/apexcharts.min.js")}}"></script>

    <script>
        var sLineArea = {
            chart: {
                height: 350,
                type: 'area',
                redrawOnParentResize: true,
                toolbar: {
                    show: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            series: [{
                name: ' المسحوبات ',
                data: {{ $amountWithdrawal }}
            }, {
                name: ' الايداعات ',
                data: {{ $amountDeposit }}
            }],
            xaxis: {
                type: 'datetime',
               // categories: ["2021-05-01", "2021-05-10", "2021-05-20", "2021-05-30", "2021-06-01", "2021-06-10", "2021-06-20"],
                categories: {!! json_encode($dates,TRUE) !!} ,
            },
            yaxis: {
                labels: {
                    offsetX: -20,
                }
            },
            tooltip: {
                x: {
                    format: 'dd/MM/yy'
                },
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#charts-area"),
            sLineArea
        );
        chart.render();
    </script>
    <script>

        $('.see-more').click(function() {
           let div = $($(this).data('div')); //div to append
           let link = $(this).data('link'); //current URL
           let page = $(this).data('page'); //get the next page #
           let thisSeeMore =$(this);
           console.log(page);
           let href = link + '?page='+ page; //complete URL
           $.ajax(
               {
                   url:   href,
                   data: {

                   },
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
   </script>
@endsection
