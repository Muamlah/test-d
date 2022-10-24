@foreach($invoices as $one)
    <a data-toggle="collapse" href="#invoice-{{@$one->id}}" aria-expanded="false" aria-controls="invoice-{{@$one->id}}"
       class="card card-style mb-2">
        <div class="content">
            <div class="d-flex mb-n1">
                <div>
                    @if(@$one->type == 'private')
                        <h3 class="font-16">{{@$one->id}}# طلب تعميد خاص </h3>
                    @elseif(@$one->type == 'public')
                        <h3 class="font-16">{{@$one->id}}# طلب تعميد عام </h3>
                    @else
                        <h3 class="font-16">{{@$one->id}}# طلب خدمة الكترونية </h3>
                    @endif
                    {{--                                <p class="opacity-80 font-10 mt-n2">التاريخ - 25th June 2020</p>--}}
                    <p class="opacity-80 font-10 mt-n2">التاريخ - {{@$one->order->created_at ? @$one->order->created_at->format('d M Y') : ''}}</p>
                </div>
                <div class="mr-auto text-center">

                    @if(@$one->order->status == 1 || @$one->order->status_id == 1 || @$one->order->status == "pinding")
                        <span class="bg-gray2-dark  rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    جاري المراجعة
                                          </span>
                    @elseif(@$one->order->status == 2 || @$one->order->status_id == 2 || @$one->order->status == "waiting")
                        <span class="bg-green2-dark  rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    مفتوح
                                          </span>
                    @elseif(@$one->order->status == 3 || @$one->order->status_id == 3 || @$one->order->status == "processing")
                        <span class="bg-yellow1-dark  rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    بانتظار التنفيذ
                                          </span>
                    @elseif(@$one->order->status == 4 || @$one->order->status_id == 4 || @$one->order->status == "completed")
                        <span class="bg-green1-dark rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    بانتظار تأكيد التسليم
                                          </span>
                    @elseif(@$one->order->status == 5 || @$one->order->status_id == 5 || @$one->order->status == "confirm_completed")
                        <span class="bg-green3-dark rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    تم التسليم
                                          </span>
                    @elseif(@$one->order->status == 10  || @$one->order->status_id == 10  || @$one->order->status == "approved-supervisor"  )
                        <span class="bg-green3-dark rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    تم التسليم
                                          </span>
                    @elseif(@$one->order->status == 6 || @$one->order->status_id == 6 || @$one->order->status == "canceled")
                        <span class="bg-red2-dark rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    بانتظار تأكيد الغاء مقدم الخدمة
                                          </span>
                    @elseif(@$one->order->status == 7 || @$one->order->status_id == 7 || @$one->order->status == "confirm_canceled")
                        <span class="bg-red2-dark rounded-xs text-uppercase font-900 font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    ملغي
                                          </span>
                    @endif

                </div>
            </div>
        </div>
    </a>
    <div class="collapse" id="invoice-{{@$one->id}}">
        <div class="card card-style">
            <div class="content">
                <div class="text-center mb-4">
                    <h3 class="color-highlight font-600 mb-n1">
                        فاتورة طلب

                        @if(@$one->order->status == 1 || @$one->order->status_id == 1 || @$one->order->status == "pinding")
                            جاري المراجعة
                        @elseif(@$one->order->status == 2 || @$one->order->status_id == 2 || @$one->order->status == "waiting")
                            مفتوح
                        @elseif(@$one->order->status == 3 || @$one->order->status_id == 3 || @$one->order->status == "processing")
                            بانتظار التنفيذ
                        @elseif(@$one->order->status == 4 || @$one->order->status_id == 4 || @$one->order->status == "completed")
                            بانتظار تأكيد التسليم
                        @elseif(@$one->order->status == 5 || @$one->order->status_id == 5 || @$one->order->status == "confirm_completed")
                            تم التسليم
                                     @elseif(@$one->order->status == 10  || @$one->order->status_id == 10  || @$one->order->status == "approved-supervisor"  )

                                                    تم التسليم
                        @elseif(@$one->order->status == 6 || @$one->order->status_id == 6 || @$one->order->status == "canceled")
                            بانتظار تأكيد الغاء مقدم الخدمة
                        @elseif(@$one->order->status == 7 || @$one->order->status_id == 7 || @$one->order->status == "confirm_canceled")
                            ملغي
                        @endif
                    </h3>
                </div>
                <div class="row mb-0">
                    <div class="col-6">
                        <h4 class="font-15">حالة الطلب</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left">

                            @if(@$one->order->status == 1 || @$one->order->status_id == 1 ||@$one->order->status == "pinding")
                                <span class="bg-gray2-dark  rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    جاري المراجعة
                                          </span>
                            @elseif(@$one->order->status == 2 || @$one->order->status_id == 2 || @$one->order->status == "waiting")
                                <span class="bg-green2-dark  rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    مفتوح
                                          </span>
                            @elseif(@$one->order->status == 3 || @$one->order->status_id == 3 || @$one->order->status == "processing")
                                <span class="bg-yellow1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    بانتظار التنفيذ
                                          </span>
                            @elseif(@$one->order->status == 4 || @$one->order->status_id == 4 || @$one->order->status == "completed")
                                <span class="bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    بانتظار تأكيد التسليم
                                          </span>
                            @elseif(@$one->order->status == 5 || @$one->order->status_id == 5 || @$one->order->status == "confirm_completed")
                                <span class="bg-green3-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    تم التسليم
                                          </span>
                                           @elseif(@$one->order->status == 10 || @$one->order->status_id == 10 || @$one->order->status == "approved-supervisor")
                                <span class="bg-green3-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    تم التسليم
                                          </span>
                            @elseif(@$one->order->status == 6 || @$one->order->status_id == 6 || @$one->order->status == "canceled")
                                <span class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    بانتظار تأكيد الغاء مقدم الخدمة
                                          </span>
                            @elseif(@$one->order->status == 7 || @$one->order->status_id == 7 || @$one->order->status == "confirm_canceled")
                                <span class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                    ملغي
                                          </span>
                            @endif

                        </h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15">رقم الطلب</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left">#{{@$one->order->id}}</h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15">مقدم الخدمة</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left">{{@$one->order->provider->name}}</h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15">طالب الخدمة</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left">{{@$one->order->user->name}}</h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15">التاريخ</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left">{{@$one->order->created_at ? @$one->order->created_at->format('d-m-Y') : ''}}</h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-12">
                        <h4 class="font-15">تفاصيل التعميد</h4>
                        <p>{{@$one->order->details}}</p>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15 mt-1">قيمة التعميد</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left mt-1 color-green1-dark">{{@$one->order->price}} ريال </h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15 mt-1">رسوم التعميد</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left mt-1 color-red2-dark">{{@$one->order->fees}} ريال </h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15 mt-1">الإجمالي</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left mt-1">{{@$one->order->total_amount}} ريال </h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15 mt-1">ضريبة القيمة المضافة</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left mt-1 color-blue2-dark">{{@$one->order->value_added_tax}} ريال </h4>
                    </div>
                    <div class="divider divider-margins w-100 mt-2 mb-2"></div>
                    <div class="col-6">
                        <h4 class="font-15 mt-1">المبلغ المدفوع</h4>
                    </div>
                    <div class="col-6">
                        <h4 class="font-15 text-left mt-1 color-blue2-dark">{{@$one->order->total_amount}} ريال </h4>
                    </div>
                    @if(@$one->order->status == 10 || @$one->order->status_id == 10 || @$one->order->status == 5  || @$one->order->status_id == 5 )
                    <div class="col-6 mt-4"><a target="_blank" href="{{route('user.print_pdf' ,['id' => $one->order->id, 'type' => $one->type])}}"
                                                class="btn btn-full btn-l rounded-l font-800 text-uppercase bg-green-c">تحميل
                            الفاتورة
                            PDF</a>
                    </div>
                    <div class="col-6 mt-4"><a target="_blank" href="{{route('view_invoice' ,['code' => $one->order->invoice_code, 'type' => $one->type])}}"
                        class="btn btn-full btn-l rounded-l font-800 text-uppercase bg-green-c">عرض الفاتورة</a>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endforeach
