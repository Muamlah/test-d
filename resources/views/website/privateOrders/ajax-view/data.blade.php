@foreach($orders as $item)
    <a href="{{route('privateOrder.show',@$item->id)}}" class="item">
        <div class="d-flex">
            <div class="pl-1">
            
                @if(@$item->status_id == '1')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-gray2-dark rounded-sm"><i
                                class="fa fa-hourglass-half"></i></span></span>
                @elseif(@$item->status_id == '2')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-gray2-dark rounded-sm"><i
                                class="fa fa-hourglass-half"></i></span></span>
                @elseif(@$item->status_id == '3')
                    <span class="icon icon-xs bg-blue-dark rounded-sm"><span
                            class="icon icon-xs bg-yellow1-dark rounded-sm"><i
                                class="fa fa-clock"></i></span></span>
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
                <p class="line-height-s font-12 pr-1 font-400">?????? ??????????  ?????? {{$item->id}} <strong class="font-800">???????? ????????????</strong>  <strong class="font-800">@if(@$item->provider->name) {{@$item->provider->name}} @else {{@$item->provider->phone}}@endif</strong>
                    <span class="font-10 line-height-xs d-block opacity-40">{{@$item->created_at->format('d-m-Y')}}</span>
                </p>
            </div>
            <div class="align-self-center text-center has-status flex-grow-1">
                {!! @$item->getHtmlStatus() !!}
            </div>
        </div>
    </a>
    <div class="divider mb-2 mt-2"></div>
@endforeach
