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

                <div class="divider mt-4"></div>
                @if($checkOffer)
                    <form action="{{route('publicOrder.editOffer',$checkOffer->id)}}" method="post" class="form-horizontal" role="form">
                        @csrf
                        @method('patch')
                <div class="input-style input-style-2 has-icon input-required">
                        <i class="fa input-icon fa-calendar-plus"></i>
                        <span class="color-highlight input-style-1-active input-style-1-inactive">فترة الإنجاز</span>
                        <em>(مطلوب)</em>
                        <input class="form-control" type="text" name="duration" value="{{$checkOffer->duration}}" placeholder="" required>
                    </div>
                    <div class="row mb-1">
                        <div class="col-6">
                            <div class="input-style input-style-2 has-icon input-required">
                                <i class="fa input-icon fa-calendar-plus"></i>
                                <span class="color-highlight input-style-1-active input-style-1-inactive"> تاريخ إنتهاء التعميد</span>

                                <input id="basicFlatpickr" name="date" value="{{@$checkOffer->date}}"
                                       class="form-control flatpickr text-right color-trn flatpickr-input" type="text"
                                       readonly="readonly">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="input-style input-style-2 has-icon input-required">
                                <i class="fa input-icon fa-calendar-plus"></i>
                                <span class="color-highlight input-style-1-active input-style-1-inactive"> وقت الإنتهاء</span>

                                <input id="timeFlatpickr"
                                       class="form-control flatpickr text-right  flatpickr-input"
                                       type="text" name="time"  required readonly="readonly">
                            </div>
                        </div>
                    </div>
                    <div class="input-style input-style-2 has-icon input-required">
                        <i class="fa input-icon fa-money-bill-wave"></i>
                        <span class="color-highlight input-style-1-active input-style-1-inactive">المبلغ المطلوب</span>
                        <em>(مطلوب)</em>
                        <input class="form-control" type="text" name="price" value="{{$checkOffer->price}}" placeholder="" required>
                    </div>

                    <button type="submit"
                        class="btn btn-m w-100 btn-full rounded-l bg-yellow-c mr-auto ml-auto font-900 text mt-4">
                        تعديل
                    </button>
                </form>
                @else
                    <form method="post" action="{{route('publicOrder.addOffer',$order->id)}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-calendar-plus"></i>
                            <span class="color-highlight">فترة الإنجاز</span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="text" name="duration" value="{{old('duration')}}" placeholder="" required>
                        </div>
                        <div class="row mb-1">

                            <div class="col-6">
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-calendar-plus"></i>
                                    <span class="color-highlightgi">تاريخ إنتهاء التعميد</span>
                                    <input id="basicFlatpickr" value="{{old('date')}}"
                                           class="form-control flatpickr text-right color-trn flatpickr-input"
                                           type="text" name="date" required  >
                                </div>
                            </div>


                            <div class="col-6">
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-calendar-plus"></i>
                                    <span class="color-highlight">وقت الإنتهاء</span>
                                    <input id="timeFlatpickr"  value="{{old('time')}}"
                                           class="form-control flatpickr text-right color-trn flatpickr-input"
                                           type="text" name="time" required >
                                </div>
                            </div>
                        </div>
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-money-bill-wave"></i>
                            <span class="color-highlight">المبلغ المطلوب</span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="text" name="price" value="{{old('price')}}" placeholder="" required>
                        </div>

                        <button type="submit"
                                class="btn btn-m w-100 btn-full rounded-l bg-yellow-c mr-auto ml-auto font-900 text mt-4">
                            قبول
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <!-- End of Page Content-->    <!-- Page Content-->

@endsection




















