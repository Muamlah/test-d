@foreach($orders as $item)
    @if($item->type == 'eservice')
        <a href="{{url('eservices_orders/myservice_details'.'/'.@$item->id)}}" class="item">
            <div class="d-flex">
                <div class="pl-1">
                    @if(@$item->status == '1')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span class="icon icon-xs bg-gray2-dark rounded-sm"><i class="fa fa-hourglass-half"></i></span></span>
                    @elseif(@$item->status == '2')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span class="icon icon-xs bg-gray2-dark rounded-sm"><i class="fa fa-hourglass-half"></i></span></span>
                    @elseif(@$item->status == '3')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span class="icon icon-xs bg-yellow1-dark rounded-sm"><i class="fa fa-clock"></i></span></span>
                    @elseif(@$item->status == '6')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span class="icon icon-xs bg-red2-dark rounded-sm"><i class="fa fa-ban"></i></span></span>
                    @elseif(@$item->status == '7')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span class="icon icon-xs bg-red3-light rounded-sm"><i class="fa fa-times"></i></span></span>
                    @elseif(@$item->status == '8')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span class="icon icon-xs bg-red3-light rounded-sm"><i class="fa fa-times"></i></span></span>
                    @elseif(@$item->status == '4')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span class="icon icon-xs bg-green1-dark rounded-sm"><i class="fa fa-check"></i></span></span>
                    @elseif(@$item->status == '5')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span class="icon icon-xs bg-highlight color-white rounded-sm"><i class="fa fa-handshake"></i></span></span>
                    @endif
                </div>
                <div class="align-self-center w-100">
                    <p class="line-height-s font-12 pr-1 font-400">
                        {{$item->service_name}} 
                        <strong class="font-800">
                            مقدم الطلب
                        </strong> 
                        <strong class="font-800">
                            {{$item->provider_phone}}
                        </strong>
                        <span class="font-10 line-height-xs d-block color-gray2-dark">{{@$item->created_at->format('d-m-Y')}}
                            {!! @$item->status_html !!}
                        </span>
                    </p>
                </div>
            </div>
        </a>
        <div class="divider mb-2 mt-2"></div>
    @elseif($item->type == 'private' || $item->type == 'public')
        @if($item->type == 'private')
            <a href="{{route('privateService.show',@$item->id)}}" class="item">
        @elseif($item->type == 'public')
            <a href="{{route('publicService.show',@$item->id)}}" class="item">
        @endif
            <div class="d-flex">
                <div class="pl-1">
                    @if(@$item->status_id == '1')
                        <span class="icon icon-xs bg-blue-dark rounded-sm">
                            <span class="icon icon-xs bg-gray2-dark rounded-sm">
                                <i class="fa fa-hourglass-half"></i>
                            </span>
                        </span>
                    @elseif(@$item->status_id == '2')
                        <span class="icon icon-xs bg-blue-dark rounded-sm">
                            <span class="icon icon-xs bg-gray2-dark rounded-sm">
                                <i class="fa fa-hourglass-half"></i>
                            </span>
                        </span>
                    @elseif(@$item->status_id == '3')
                        <span class="icon icon-xs bg-blue-dark rounded-sm">
                            <span class="icon icon-xs bg-yellow1-dark rounded-sm">
                                <i class="fa fa-clock"></i></span></span>
                    @elseif(@$item->status_id == '6')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                class="icon icon-xs bg-red2-dark rounded-sm"><i
                                    class="fa fa-ban"></i></span>
                            @elseif(@$item->status_id == '8')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                class="icon icon-xs bg-red2-dark rounded-sm"><i
                                    class="fa fa-ban"></i></span></span>
                    @elseif(@$item->status_id == '7')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                class="icon icon-xs bg-red3-light rounded-sm"><i
                                    class="fa fa-times"></i></span></span>
                    @elseif(@$item->status_id == '4')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                class="icon icon-xs bg-green1-dark rounded-sm"><i
                                    class="fa fa-check"></i></span></span>
                    @elseif(@$item->status_id == '5')
                        <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                                class="icon icon-xs bg-highlight color-white rounded-sm"><i
                                    class="fa fa-handshake"></i></span></span>
                    @endif
                </div>
                <div class="align-self-center w-100">
                    <p class="line-height-s font-12 pr-1 font-400">طلب تعميد  رقم {{$item->id}} <strong class="font-800">طالب الخدمة</strong>  <strong class="font-800">@if(@$item->user_name) {{@$item->user_name}} @else {{@$item->user_phone}}@endif</strong>
                        <span class="font-10 line-height-xs d-block opacity-40">{{@$item->formated_created_at}}</span>
                    </p>
                </div>
                <div class="align-self-center text-center has-status flex-grow-1">
                                    <span
                                        class=" @if(@$item->status_id == '1')
                                            bg-gray2-dark
                                        @elseif(@$item->status_id == '2')
                                            bg-gray2-dark
                                        @elseif(@$item->status_id == '3')
                                            bg-yellow1-dark
                                        @elseif(@$item->status_id == '6')
                                            bg-red2-dark
                                        @elseif(@$item->status_id == '8' || @$item->status_id == '9')
                                            bg-red2-dark
                                        @elseif(@$item->status_id == '7')
                                            bg-red3-light
                                        @elseif(@$item->status_id == '4')
                                            bg-green1-dark
                                        @elseif(@$item->status_id == '5')
                                            bg-highlight color-white
                                            @endif
                                            rounded-xs text-uppercase font-10 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                {{@$item->status_name}}
                                    </span>
                </div>
            </div>
        </a>
        <div class="divider mb-2 mt-2"></div>
    @endif
@endforeach