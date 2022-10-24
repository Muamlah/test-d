@foreach($orders as $item)
    @if($item->type == 'eservice')
        @if(auth()->check())
            <div class="card card-style">
                <div class="content">
                    <div class="d-flex mb-4">
                        <div class="align-self-center">
                            <span class="icon icon-xxl rounded-m me-3">
                                <img src="{{asset('public/storage').'/'.$item->service_image}}" width="60" class="rounded-sm"></span>
                        </div>
                        <div class="align-self-center w-100 mr-2">
                            <h4>
                                {{@$item->service_name}}
                                <strong class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                    {{@$item->service_price}}
                                </strong>
                            </h4>
                            <p class="mb-0 opacity-60 line-height-s font-14">
                                {{@$item->details}}
                            </p>
                        </div>
                    </div>
                    <div class="row mb-n2 text-center">
                        <div class="col-12">
                            @if(auth()->check() && auth()->user()->level == "provider")
                                <div class="divider"></div>
                                <form action="{{url('eservices_order').'/accept/'.$item->id}}" method="POST" role="form">
                                    @csrf
                                    @if($electronic_provider_count >= $setting->electronic_order_provider_limit && ($setting->electronic_order_provider_limit!=0 || $setting->electronic_order_provider_limit!=null))
                                        <button class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4" disabled>
                                            قبول
                                        </button>
                                    @else
                                        <button class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">
                                            قبول
                                        </button>
                                    @endif
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card card-style">
                <div class="content">
                    <div class="d-flex mb-4">
                        <div class="align-self-center">
                            <span class="icon icon-xxl rounded-m me-3">
                                <img src="{{asset('public/storage').'/'.$item->service_image}}" width="60" class="rounded-sm">
                            </span>
                        </div>
                        <div class="align-self-center w-100 mr-2">
                            <h4>
                                {{@$item->service_name}}
                                <strong class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                    {{@$item->service_price}}
                                </strong>
                            </h4>
                            <p class="mb-0 opacity-60 line-height-s font-14">
                                {{@$item->details}}
                            </p>
                        </div>
                    </div>
                    <div class="divider mb-2 mt-n2"></div>
                    <div class="row mb-n2 text-center">
                        <div class="col-12">
                            <a href="{{route('login')}}"
                                class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                                قبول
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @elseif($item->type == 'public')
        @if(auth()->check())
            @if(auth()->user()->level == 'provider')
                <div class="card card-style">
                    <div class="content">
                        <div class="d-flex mb-4">
                            <div class="align-self-center">
                                <span class="icon icon-xxl rounded-m me-3">
                                    <img src="{{asset('public/template-muamlah/images/logo.png')}}" width="60" class="rounded-sm">
                                </span>
                            </div>
                            <div class="align-self-center w-100 mr-2">
                                <h4>
                                    {{@$item->title}}
                                    <strong class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                        مفتوح
                                    </strong>
                                </h4>
                                <p class="mb-0 opacity-60 line-height-s font-14">
                                    {{@$item->details}}
                                </p>
                            </div>
                        </div>
                        <div class="divider mb-2 mt-n2"></div>
                        <div class="row mb-n2 text-center">
                            <div class="col-12">
                                @if(\App\Models\PublicOrderOffer::where('user_id',auth()->user()->id)->where('order_id',$item->id)->first())
                                    <a href="{{route('publicOrders.offers.edit',@$item->id)}}" class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">تعديل
                                        عرضك الحالي
                                    </a>
                                @elseif(auth()->user()->level == 'provider')
                                    @if($order_offer_count >= $setting->offers_public_order_limit)
                                        <a href="#" class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90" disabled="">أضف
                                            عرضك الأن
                                        </a>
                                    @else
                                        <a href="{{route('publicOrders.offers.create',@$item->id)}}" class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                                            أضف عرضك الأن
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="card card-style">
                    <div class="content">
                        <div class="d-flex mb-4">
                            <div class="align-self-center">
                                <span class="icon icon-xxl rounded-m me-3">
                                    <img src="{{asset('public/template-muamlah/images/logo.png')}}" width="60" class="rounded-sm">
                                </span>
                            </div>
                            <div class="align-self-center w-100 mr-2">
                                <h4>{{@$item->title}}
                                    <strong class=" @if(@$item->status == 1)
                                            bg-gray2-dark
                                                @elseif(@$item->status == 2)
                                            bg-green2-dark
                                                @elseif(@$item->status == 3)
                                            bg-yellow1-dark
                                                @elseif(@$item->status == 6)
                                            bg-red2-dark
                                                @elseif(@$item->status == 7)
                                            bg-red3-light
                                                @elseif(@$item->status == 5)
                                            bg-green1-dark
                                                @elseif(@$item->status == 6)
                                            bg-highlight color-white
                                                @endif
                                            rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                        @if(@$item->status == 2)
                                            مفتوح
                                        @else
                                            {{$item->st->name}}
                                        @endif
                                    </strong>
                                </h4>
                                <p class="mb-0 opacity-60 line-height-s font-14">
                                    {{@$item->details}}
                                </p>
                            </div>
                        </div>
                        <div class="divider mb-2 mt-n2"></div>
                        <div class="row mb-n2 text-center">
                            <div class="col-12">
                                @if(($item->status == 1 || $item->status == 2) && $item->user_id == auth()->user()->id)
                                    <a href="{{route('publicOrders.offers.show',@$item->id)}}" class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                                        مشاهدة العروض
                                    </a>
                                @else
                                    <a href="{{route('publicOrders.offers.showDetails',@$item->id)}}" class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                                        تفاصيل الطلب
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="card card-style">
                <div class="content">
                    <div class="d-flex mb-4">
                        <div class="align-self-center">
                            <span class="icon icon-xxl rounded-m me-3">
                                <img src="{{asset('public/template-muamlah/images/logo.png')}}" width="60" class="rounded-sm">
                            </span>
                        </div>
                        <div class="align-self-center w-100 mr-2">
                            <h4>
                                {{@$item->title}}
                                <strong class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                    مفتوح
                                </strong>
                            </h4>
                            <p class="mb-0 opacity-60 line-height-s font-14">
                                {{@$item->details}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="divider mb-2 mt-n2"></div>
                <div class="row mb-2 text-center">
                    <div class="col-12">
                        <a href="{{route('login')}}" class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                            أضف عرضك الأن
                        </a>
                    </div>
                </div>
            </div>
        @endif
    @endif
@endforeach