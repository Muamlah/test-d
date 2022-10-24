@extends('website.layout')

@section('content')

    <!-- Page Content-->
    <div class="page-content header-clear-medium">

        @if ($message = Session::get('success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{$message}}</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if (Session::get('error') )
        <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
            <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
            <strong>{{Session::get('error')}} </strong>
            <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif
        <div class="card card-overflow card-style">
            <div class="content">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h1 class="font-30">{{@$order->title}}</h1>
                    </div>
                    <div class="flex-shrink-1">
                        <strong
                            class="bg-green2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">مفتوح</strong>
                    </div>
                </div>

                <div class="divider"></div>

                <p>
                    <strong>تفاصيل الطلب</strong><br>
                    {{@$order->details}}
                </p>


{{--                <div class="row">--}}
{{--                    <div class="col-6">--}}
{{--                        <div class="mx-0 mb-3 text-center">--}}
{{--                            <h6 class="font-14 font-800 text-uppercase color-gray3-light">رسوم التعميد</h6>--}}
{{--                            <h3 class="color-gray2-dark font-16 mb-0">{{@$fees->offer_platform_fee}} %</h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-6">--}}
{{--                        <div class="mx-0 mb-3 text-center">--}}
{{--                            <h6 class="font-14 font-800 text-uppercase color-gray3-light">--}}
{{--                                مبلغ الضريبة المضافة--}}
{{--                            </h6>--}}
{{--                            <h3 class="color-gray2-dark font-16 mb-0">{{@$fees->public_order_added_tax}} ريال </h3>--}}
{{--                        </div>--}}
{{--                    </div>--}}


{{--                </div>--}}
                <div class="divider"></div>

                    <form action="{{route('publicOrders.offers.editOffer',$offer->id)}}" method="post" class="form-horizontal" role="form">
                        @csrf
                        @method('patch')

                        <div class="row mb-1">
                            <div class="col-12">
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-calendar-plus"></i>
                                    <span class="color-highlight input-style-1-active input-style-1-inactive">تاريخ إنتهاء التعميد</span>

                                    <input id="basicFlatpickr1" name="date"
                                           class="form-control flatpickr text-right flatpickr-input" type="date"
                                           required  readonly value="">
                                </div>
                            </div>

                            {{-- <div class="col-6">
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-calendar-plus"></i>
                                    <span class="color-highlight input-style-1-active input-style-1-inactive"> وقت الإنتهاء</span>

                                    <input id="timeFlatpickr1"
                                           class="form-control flatpickr text-right  flatpickr-input"
                                           type="text" name="time"  required readonly="readonly">
                                </div>
                            </div> --}}
                        </div>
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-money-bill-wave"></i>
                            <span class="color-highlight input-style-1-active input-style-1-inactive">المبلغ المطلوب</span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="text" oninput="checkPrice(this)" name="price" value="{{$offer->price}}" placeholder="" required>
                        </div>
                        <div class="divider mt-4"></div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mx-0 mb-3 text-center">
                                    <h6 class="font-14 font-800 text-uppercase color-gray3-light">رسوم التعميد</h6>
                                    <h3 class="color-gray2-dark font-16 mb-0" id="fee">{{$fee['fee']}}</h3>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mx-0 mb-3 text-center">
                                    <h6 class="font-14 font-800 text-uppercase color-gray3-light">
                                        مبلغ الضريبة المضافة
                                    </h6>
                                    <h3 class="color-gray2-dark font-16 mb-0" id="amount_tax">{{$fee['tax_amount']}}</h3>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mx-0 mb-3 text-center">
                                    <h6 class="font-14 font-800 text-uppercase color-gray3-light">
                                        المبلغ المستحق
                                    </h6>
                                    <h3 class="color-gray2-dark font-16 mb-0" id="deserved_price">{{$fee['deserved_price']}}</h3>
                                </div>
                            </div>
                        <div class="divider mt-4"></div>

                        </div>
                        <button type="submit"
                                class="btn btn-m w-100 btn-full rounded-l bg-yellow-c mr-auto ml-auto font-900 text mt-4">
                             تعديل العرض
                        </button>
                    </form>

            </div>
        </div>
    </div>
    <!-- End of Page Content-->
    <!-- Page Content-->

@endsection


@section('script')
    <script type="text/javascript">
        var f1 = flatpickr(document.getElementById('basicFlatpickr1'), {
            dateFormat: "Y-m-d",
            disableMobile: "true",
            defaultDate: '{{ \Carbon\Carbon::parse($offer->deadline)->format('Y-m-d') }}'
        });
        {{--var f2 = flatpickr(document.getElementById('timeFlatpickr1'), {--}}
        {{--    enableTime: true,--}}
        {{--    noCalendar: true,--}}
        {{--    dateFormat: "H:i",--}}
        {{--    defaultDate: '{{\Carbon\Carbon::parse($offer->deadline)->format('H:i')}}'--}}
        {{--});--}}
    </script>


    <script>
        function checkPrice(_this) {
            if(_this.value) {
                $("#fees").show('slow');
                var price =_this.value;
                let dataFrom =  {
                    price: price,
                };
                $.ajax({
                    url: "{{ route('publicOrders.calculatePrice') }}",
                    type: "GET",
                    data: dataFrom,

                    success(response) {
                        console.log(response.message);
                        if (response.error == 1) {
                            return 0;
                        }
                        $("#amount_tax").html(`${response.message.tax_amount}<small class="grey-text">   ريال</small>`);
                        $("#deserved_price").html(`${response.message.deserved_price}<small class="grey-text">   ريال</small>`);
                        $("#fee").html(`${response.message.fee}<small class="grey-text">   ريال</small>`);


                    }
                });

            }else {
                $("#fees").hide('slow');
            }
        }
    </script>
@endsection
