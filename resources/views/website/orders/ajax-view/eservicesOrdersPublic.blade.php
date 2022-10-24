@forelse($eservices_orders as $r)
<div class="card card-style">
    <div class="content">
        <div class="d-flex mb-4">
            <div class="align-self-center">
                <span class="icon icon-xxl rounded-m me-3"><img
                        src="{{asset('public/storage').'/'.$r->eservices->img}}" width="60" class="rounded-sm"></span>
            </div>
            <div class="align-self-center w-100 mr-2">
                <h4>{{$r->eservices->service_name}}<strong
                        class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">{{$r->eservices->price}}</strong>
                </h4>
                <p class="mb-0 opacity-60 line-height-s font-14">
                    {{$r->details}}
                </p>
            </div>
        </div>
        <!--    <div class="divider mb-2 mt-n2"></div> -->
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
@empty
    <h4 class="text-center"> لا يوجد طلبات</h4>
@endforelse
