@foreach($items as $item)
    <a href="{{route('privateService.show',@$item->id)}}" class="item">
        <div class="d-flex">
            <div class="pl-1">
                @if(@$item->status == 'pending')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-gray2-dark rounded-sm"><i
                                class="fa fa-hourglass-half"></i></span></span>
                @elseif(@$item->status == 'waiting')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-yellow1-dark rounded-sm"><i class="fa fa-hourglass-half"></i></span></span>
                @elseif(@$item->status == 'processing')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-yellow1-dark rounded-sm"><i class="fa fa-clock"></i></span></span>
                @elseif(@$item->status == 'canceled')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-red2-dark rounded-sm"><i class="fa fa-ban"></i></span></span>
                @elseif(@$item->status == 'report')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-red2-dark rounded-sm"><i class="fa fa-ban"></i></span></span>
                @elseif(@$item->status == 'confirm_canceled')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-red3-light rounded-sm"><i class="fa fa-times"></i></span></span>
                @elseif(@$item->status == 'completed')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-green1-dark rounded-sm"><i class="fa fa-check"></i></span></span>
                @elseif(@$item->status == 'confirm_completed')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-highlight color-white rounded-sm"><i
                                class="fa fa-handshake"></i></span></span>
                @endif
            </div>
            <div class="align-self-center w-100">
                <p class="line-height-s font-12 pr-1 font-400">طلب تعميد رقم {{$item->id}} <strong class="font-800">مقدم
                        الطلب</strong> <strong
                        class="font-800">@if(@$item->user->name) {{@$item->user->name}} @else {{@$item->user->phone}}@endif</strong>
                    <span class="font-10 line-height-xs d-block color-gray2-dark">{{@$item->created_at->format('d-m-Y')}}
                                                        <span class=" @if(@$item->status == 'pending')
                                                            bg-gray2-dark
                                                            @elseif(@$item->status == 'waiting')
                                                            bg-yellow1-dark
                                                            @elseif(@$item->status == 'processing')
                                                            bg-yellow1-dark
                                                            @elseif(@$item->status == 'canceled')
                                                            bg-red2-dark
                                                            @elseif(@$item->status == 'report')
                                                            bg-red2-dark
                                                            @elseif(@$item->status == 'confirm_canceled')
                                                            bg-red3-light
                                                            @elseif(@$item->status == 'completed')
                                                            bg-green1-dark
                                                            @elseif(@$item->status == 'confirm_completed')
                                                            bg-highlight color-white
                                                            @endif
                                                            rounded-xs text-uppercase float-left font-10 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                            @if(@$item->status == 'pending')
                                                                بإنتظارالمراجعة
                                                            @elseif(@$item->status == 'waiting')
                                                                بإنتظار الموافقة
                                                            @elseif(@$item->status == 'processing')
                                                                بإنتظار التنفيد
                                                            @elseif(@$item->status == 'canceled')
                                                                بانتظار الغاء مقدم الخدمة@elseif(@$item->status == 'report')
                                                                بلاغ
                                                            @elseif(@$item->status == 'confirm_canceled')
                                                                ملغي
                                                            @elseif(@$item->status == 'completed')
                                                                بإنتظار الإستلام
                                                            @elseif(@$item->status == 'confirm_completed')
                                                                تم التسليم
                                                            @endif
                                                        </span>
                                                    </span>
                </p>
            </div>
        </div>
    </a>
    <div class="divider mb-2 mt-2"></div>
@endforeach
