@forelse($my_orders as $one)
    <div class="card card-style">
        <div class="content">
            <div class="d-flex mb-4">
                <div class="align-self-center">
                                        <span class="icon icon-xxl rounded-m me-3"><img
                                                src="{{asset('public/template-muamlah/images/logo.png')}}"
                                                width="60" class="rounded-sm"></span>
                </div>
                <div class="align-self-center w-100 mr-2">
                    <h4>{{@$one->title}}
                        <strong
                            class=" @if(@$one->status == 1)
                                bg-gray2-dark
@elseif(@$one->status == 2)
                                bg-green2-dark
@elseif(@$one->status == 3)
                                bg-yellow1-dark
@elseif(@$one->status == 6)
                                bg-red2-dark
@elseif(@$one->status == 7)
                                bg-red3-light
@elseif(@$one->status == 5)
                                bg-green1-dark
@elseif(@$one->status == 6)
                                bg-highlight color-white
@endif
                                rounded-xs text-uppercase float-left
                            font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                            @if(@$one->status == 2)
                                مفتوح
                            @else
                                {{$one->st->name}}
                            @endif
                        </strong>

                    </h4>
                    <p class="mb-0 opacity-60 line-height-s font-14">
                        {{@$one->details}}
                    </p>
                </div>
            </div>
            <div class="divider mb-2 mt-n2"></div>
            <div class="row mb-n2 text-center">
                <div class="col-12">
                    @if(($one->status == 1 || $one->status == 2) && $one->user_id == auth()->user()->id)
                        <a href="{{route('publicOrders.offers.show',@$one->id)}}"
                           class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                            مشاهدة العروض
                        </a>
                    @else
                        <a href="{{route('publicOrders.offers.showDetails',@$one->id)}}"
                           class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                            تفاصيل الطلب
                        </a>

                    @endif

                </div>
            </div>
        </div>
    </div>
@empty
    <h4 class="text-center"> لا يوجد طلبات</h4>
@endforelse
