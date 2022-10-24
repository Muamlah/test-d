@foreach($publicOrders as $item)

        @if($item->status == 1 || $item->status == 2)
            <a href="{{route('publicOrders.offers.show',@$item->id)}}" class="item">
         @else
           <a href="{{route('publicOrders.showDetails',@$item->id)}}" class="item">
        @endif

        <div class="d-flex">
            <div class="pl-1">
                @if(@$item->status == 1)
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-gray2-dark rounded-sm"><i
                                class="fa fa-hourglass-half"></i></span></span>
                @elseif(@$item->status == 2)
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-gray2-dark rounded-sm"><i
                                class="fa fa-hourglass-half"></i></span></span>
                @elseif(@$item->status == 3)
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-yellow1-dark rounded-sm"><i
                                class="fa fa-clock"></i></span></span>
                @elseif(@$item->status == 6)
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-red2-dark rounded-sm"><i
                                class="fa fa-ban"></i></span>
                        @elseif(@$item->status == 8)
                            <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                    class="icon icon-xs bg-red2-dark rounded-sm"><i
                                        class="fa fa-ban"></i></span></span>
                        @elseif(@$item->status == 7 || @$item->status == 8|| @$item->status == 9)
                            <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                    class="icon icon-xs bg-red3-light rounded-sm"><i
                                        class="fa fa-times"></i></span></span>
                        @elseif(@$item->status == 4)
                            <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                    class="icon icon-xs bg-green1-dark rounded-sm"><i
                                        class="fa fa-check"></i></span></span>
                        @elseif(@$item->status == 5)
                            <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                    class="icon icon-xs bg-highlight color-white rounded-sm"><i
                                        class="fa fa-handshake"></i></span></span>
                        @elseif(@$item->status == 10)
                            <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                    class="icon icon-xs bg-highlight color-white rounded-sm"><i
                                        class="fa fa-handshake"></i></span></span>
                @endif
            </div>
            <div class="align-self-center w-100">
                <p class="line-height-s font-12 pr-1 font-400">خدمة الكترونية  رقم {{$item->id}} <strong class="font-800">مقدم الخدمة</strong>  <strong class="font-800">@if(@$item->provider->name) {{@$item->provider->name}} @else {{@$item->provider->phone}}@endif</strong>
                    <span class="font-10 line-height-xs d-block opacity-40">{{@$item->created_at->format('d-m-Y')}}</span>
                </p>
            </div>
            <div class="align-self-center text-center has-status flex-grow-1">
                                <span
                                    class=" @if(@$item->status == 1)
                                        bg-gray2-dark
                                    @elseif(@$item->status == 2)
                                        bg-gray2-dark
                                    @elseif(@$item->status == 3)
                                        bg-yellow1-dark
                                    @elseif(@$item->status == 6)
                                        bg-red2-dark
                                    @elseif(@$item->status == 'report')
                                        bg-red2-dark
                                    @elseif(@$item->status == 7 || @$item->status == 8|| @$item->status == 9)
                                        bg-red3-light
                                    @elseif(@$item->status == 4)
                                        bg-green1-dark
                                    @elseif(@$item->status == 5 || @$item->status == 10)
                                        bg-highlight color-white
                                        @endif
                                        rounded-xs text-uppercase font-10 pr-2 pl-2 pb-1 pt-1 line-height-s">
                               @if(@$item->status == 1)
                                        بإنتظارالمراجعة
                                    @elseif(@$item->status == 2)
                                        بإنتظار الموافقة
                                    @elseif(@$item->status == 3)
                                        بإنتظار التنفيد
                                    @elseif(@$item->status == 6)
                                        بانتظار الغاء مقدم الخدمة
                                    @elseif(@$item->status == 'report')
                                        بلاغ
                                    @elseif(@$item->status == 7)
                                        ملغي
                                    @elseif(@$item->status == 9)
                                        الغاء مشرف
                                    @elseif(@$item->status == 4)
                                        بإنتظار الإستلام
                                    @elseif(@$item->status == 5)
                                        تم التسليم
                                    @elseif(@$item->status == 10)
                                        تسليم مشرف
                                    @elseif(@$item->status == 8)
                                        إبلاغ
                                    @endif
                                </span>
            </div>
        </div>
    </a>
    <div class="divider mb-2 mt-2"></div>
@endforeach
