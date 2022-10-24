@forelse($orders as $one)
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
                            class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                            مفتوح
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

                    @if(\App\Models\PublicOrderOffer::where('user_id',auth()->user()->id)->where('order_id',$one->id)->first())
                        <a href="{{route('publicOrders.offers.edit',@$one->id)}}"
                           class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">تعديل
                            عرضك الحالي
                        </a>
                    @elseif(auth()->user()->level == 'provider')

                        @if($order_offer_count >= $setting->offers_public_order_limit)
                            <a href="#"
                               class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90" disabled="">أضف
                                عرضك الأن
                            </a>
                        @else
                            <a href="{{route('publicOrders.offers.create',@$one->id)}}"
                               class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">أضف
                                عرضك الأن
                            </a>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
@empty
     <h4 class="text-center"> لا يوجد طلبات</h4>
@endforelse
