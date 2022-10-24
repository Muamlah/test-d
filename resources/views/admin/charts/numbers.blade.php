<div class="row">
    <div class="col-md-3">
        <div class="card-counter primary2">
            <i class="fas fa-envelope"></i>
        <span class="count-numbers" id="messages-count-number">0</span>
        <span class="count-name">
            <a href="{{route('admin.messages.index')}}?unseen=1" style="color: #fff">
                الرسائل
            </a>
        </span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-counter danger2">
            <i class="fas fa-users"></i>
        <span class="count-numbers">{{\App\Models\User::where('in_review', '1')->count()}}</span>
        <span class="count-name">
            <a href="{{route('admin.indexUser')}}?in_review=1" style="color: #fff">
                مستخدمين بانتظار المراجعة
            </a>
        </span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-counter primary">
            <i class="fas fa-users"></i>
        <span class="count-numbers">{{$number_of_users}}</span>
        <span class="count-name">{{__('dashboard.number_of_users')}}</span>
        </div>
    </div>

{{--    <div class="col-md-4">--}}
{{--        <div class="card-counter danger">--}}
{{--            <i class="fas fa-bars"></i>--}}
{{--        <span class="count-numbers">{{$number_of_services}}</span>--}}
{{--        <span class="count-name">{{__('dashboard.number_of_services')}}</span>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="col-md-3">
        <div class="card-counter success">
            <i class="fas fa-handshake"></i>
        <span class="count-numbers">{{$number_of_orders}}</span>
        <span class="count-name">{{__('dashboard.number_of_orders')}}</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-counter info">
            <i class="fas fa-hand-holding-usd"></i>
        <span class="count-numbers">{{$total}}</span>
        <span class="count-name">{{__('dashboard.total')}}</span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-counter primary">
            <i class="fas fa-users"></i>
        <span class="count-numbers">{{$users_balance}}</span>
        <span class="count-name">
            <a href="{{route('admin.indexWrongUser')}}" style="color: #fff">
                المستخدمين اصحاب رصيد خاطئ
            </a>
        </span>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-counter danger">
            <i class="fas fa-bars"></i>
            <span class="count-numbers">{{$number_of_report_public_orders}}</span>
            <span class="count-name">طلبات إبلاغ الخدمات الإلكترونية</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card-counter info">
            <i class="fas fa-bars"></i>
            <span class="count-numbers">{{$number_of_report_private_orders}}</span>
            <span class="count-name">طلبات إبلاغ التعميد الخاص</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <h4 class="text-center">
            {{__('dashboard.wating_orders')}}
        </h4>
    </div>
{{--    <div class="col-md-3">--}}
{{--        <div class="card-counter primary2">--}}
{{--            <i class="fas fa-money-check"></i>--}}
{{--        <span class="count-numbers">{{$number_of_eservices_orders}}</span>--}}
{{--        <span class="count-name">{{__('dashboard.eservices_orders')}}</span>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="col-md-4">--}}
{{--        <div class="card-counter danger2">--}}
{{--            <i class="fas fa-money-check"></i>--}}
{{--        <span class="count-numbers">{{$number_of_public_orders}}</span>--}}
{{--        <span class="count-name">{{__('dashboard.public_order')}}</span>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="col-md-6">
        <div class="card-counter success2">
            <i class="fas fa-money-check"></i>
        <span class="count-numbers">{{$number_of_private_orders}}</span>
        <span class="count-name">{{__('dashboard.private_order')}}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-counter info2">
            <i class="fas fa-money-check"></i>
        <span class="count-numbers">{{$number_of_balance_orders}}</span>
        <span class="count-name">{{__('dashboard.balance_order')}}</span>
        </div>
    </div>
</div>
{{--<br/>--}}
{{--<div class="row">--}}
{{--    <div class="col-md-12">--}}
{{--        <h4 class="text-center">--}}
{{--            طلبات التبليغ--}}
{{--        </h4>--}}
{{--    </div>--}}


{{--    <div class="col-md-4">--}}
{{--        <div class="card-counter primary2">--}}
{{--            <i class="fas fa-bars"></i>--}}
{{--        <span class="count-numbers">{{$number_of_report_eservices_orders}}</span>--}}
{{--        <span class="count-name">طلبات إبلاغ الخدمات الإلكترونية</span>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
