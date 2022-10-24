@extends('admin.layouts.adminLayout')
@section('title')
     طلبات الإبلاغ الخاصة بالمستخدم {{$user->email}}
@endsection

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            ادارة الطلبات
        </li>
        <li class="breadcrumb-item text-muted">
             طلبات الإبلاغ الخاصة بالمستخدم {{$user->email}}
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات التعميد الخاص',
        'link1'         => route('admin.private_orders'),

    ])
@endsection

@section('content')
    <div class="card card-custom" style="padding: 20px;margin-bottom:30px">
        <div class="accordion accordion-toggle-arrow" id="accordionExample1">
            <div class="card">
                <div class="card-header">
                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false">
                        بحث متقدم
                    </div>
                </div>
                <div id="collapseOne1" class="collapse" data-parent="#accordionExample1" style="">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>الحالة </label>
                                    <select style="padding: 0 5px" class="form-control" id="kt_datatable_search_status">
                                        <option value="">كل الحالات</option>
                                        <option value="1">بانتظار المراجعة</option>
                                        <option value="2">مفتوح</option>
                                        <option value="3">قيد التنفيذ</option>
                                        <option value="4">بإنتظار الإستلام</option>
                                        <option value="5">تم التسليم</option>
                                        <option value="6">بانتظار الغاء مقدم الخدمة</option>
                                        <option value="7">ملغي</option>
                                        <option value="8">بلاغ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>حالةالدفع </label>
                                    <select style="padding: 0 5px" class="form-control" id="kt_datatable_search_type">
                                        <option value="">كل حالات الدفع</option>
                                        <option value="processing_convert">بانتظار التحويل</option>
                                        <option value="complete_convert">تم الدفع</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>من قيمة </label>
                                    <input type="number" id="kt_datatable_amount_from" class="form-control" placeholder="من قيمة">
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>إلى قيمة </label>
                                    <input type="number"  id="kt_datatable_amount_to" class="form-control" placeholder="إلى قيمة"/>
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>من تاريخ </label>
                                    <input type="date" class="form-control kt_datatable_date_from" placeholder="من تاريخ">
                                    {{-- <input type="text" class="form-control kt_datatable_date_from" id="kt_datepicker_1" placeholder="من تاريخ"/> --}}
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>إلى تاريخ </label>
                                    <input type="date"  id="kt_datatable_date_to" class="form-control" placeholder="إلى تاريخ">
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>رقم الهاتف </label>
                                    <input type="number" id="kt_datatable_phone" class="form-control" placeholder="رقم الهاتف">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-custom">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label"> طلبات الإبلاغ الخاصة بالمستخدم {{$user->email}} </h3>
            </div>
            <div class="card-toolbar"></div>
        </div>
        <div class="card-body">
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-xl-12">
                        <div class="row align-items-center">
                            <div class="bd-example bd-example-tabs">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">طلبات الخدمات الإلكترونية</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">طلبات التعميد الخاص</a>
                                    </li>
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">طلبات الخدمات الإلكترونية</a>--}}
{{--                                    </li>--}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div>
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt-user-public-orders"></div>

                    </div>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div>
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt-user-private-orders"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    <div>
                        <div class="datatable datatable-bordered datatable-head-custom" id="kt-user-eservices-orders"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    @include('admin.balance_requests.user_private_orders',['user_id'=>$user->id , 'status' => 8])
    @include('admin.balance_requests.user_public_orders',['user_id'=>$user->id , 'status' => 8])
    @include('admin.balance_requests.user_eservices_orders',['user_id'=>$user->id , 'status' => 8])
@endsection
