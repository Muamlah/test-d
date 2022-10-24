@extends('admin.layouts.adminLayout')
@section('title')طلبات الخدمات الالكترونية
@endsection
@section('content')
{{--    <div class="card card-custom">--}}
{{--        <div class="card-header flex-wrap py-3">--}}
{{--            <div class="card-title">--}}
{{--                <h3 class="card-label">قائمة طلبات الخدمات الاكترونية </h3>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <!--begin::Search Form-->--}}
{{--            <div class="mb-7">--}}
{{--                <div class="row align-items-center">--}}
{{--                    <div class="col-lg-9 col-xl-8">--}}
{{--                        <div class="row align-items-center">--}}
{{--                            <div class="col-md-5 my-2 my-md-0">--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    <label class="mr-3 mb-0 d-none d-md-block">الحالة:</label>--}}
{{--                                    <select class="form-control" id="kt_datatable_search_status">--}}
{{--                                        <option value="">كل الحالات</option>--}}
{{--                                        <option value="waiting">بإنتظار الموافقة</option>--}}
{{--                                        <option value="pending">بانتظار المراجعة</option>--}}
{{--                                        <option value="processing">قيد التنفيذ</option>--}}
{{--                                        <option value="completed">بإنتظار الإستلام</option>--}}
{{--                                        <option value="confirm_completed">تم التسليم</option>--}}
{{--                                        <option value="canceled">بانتظار الغاء مقدم الخدمة</option>--}}
{{--                                        <option value="confirm_canceled">ملغي</option>--}}
{{--                                        <option value="report">بلاغ</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-5 my-2 my-md-0">--}}
{{--                                <div class="d-flex align-items-center">--}}
{{--                                    <label class="mr-3 mb-0 d-none d-md-block">حالةالدفع:</label>--}}
{{--                                    <select class="form-control" id="kt_datatable_search_type">--}}
{{--                                        <option value="">كل حالات الدفع</option>--}}
{{--                                        <option value="processing_convert">بانتظار التحويل</option>--}}
{{--                                        <option value="complete_convert">تم الدفع</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!--end: Search Form-->--}}
{{--            <!--begin: Datatable-->--}}
{{--            <div class="datatable " id="kt_datatable"></div>--}}
{{--            <!--end: Datatable-->--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">طلبات الخدمات الالكترونية</span>
                            </h3> </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bolder text-muted">
                                        <th class="min-w-150px">#</th>
                                        <th class="min-w-140px">رقم العميل</th>
                                        <th class="min-w-140px">رقم مقدم الخدمة</th>
                                        <th class="min-w-140px">الخدمة المطلوبة</th>
                                        <th class="min-w-140px">سعر الخدمة</th>
                                        <th class="min-w-140px">تفاصيل الطلب</th>
                                        <th class="min-w-140px">حالة الدفع</th>
                                        <th class="min-w-140px">الحالة</th>
                                        <th class="min-w-100px text-end">العمليات</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach($eservices_orders as $r)
                                    <tr>
                                        <td> {{$r->id}} </td>
                                        <td> {{$r->users->phone}} </td>
                                        <td> <?php
                                        if($r->provider_id == 0) {
                                            echo "لم يتم قبول الطلب بعد";
                                        }else {
                                            echo $r->providers->phone;
                                        }
                                        ?> </td>

                                        <td> <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$r->eservices->service_name}}</a> </td>
                                        <td> <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$r->eservices->price}}</a> </td>
                                        <td> <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{$r->details}}</a> </td>



                                    <td> <span class="badge badge-light-success">
                                    <?php
                                if($r->pay_status == "processing_convert") { echo "جاري الدفع"; }
                                if($r->pay_status == "waiting") { echo "تم الدفع"; }
                                    ?>
                                        </span>
                                    </td>


                                    <td> <span class="badge badge-light-success">
                                    <?php
                                    if($r->status == "pending") { echo "بانتظار المراجعة"; }
                                    if($r->status == "waiting") { echo " بإنتظار الموافقة"; }
                                    if($r->status == "processing") { echo " قيد التنفيذ "; }
                                    if($r->status == "canceled") { echo " بانتظار الغاء مقدم الخدمة"; }
                                    if($r->status == "confirm_canceled") { echo " ملغي"; }
                                    if($r->status == "completed") { echo " بإنتظار الإستلام"; }
                                    if($r->status == "confirm_completed") { echo " تم التسليم"; }
                                    if($r->status == "report") { echo " بلاغ"; }
                                    ?>
                                        </span>
                                    </td>



                                        <td class="text-end">

                                            <a href="{{url('admin/eservices_orders/').'/'.$r->id.'/edit'}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/stockholm/Communication/Write.svg--><span class="svg-icon svg-icon-3">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                        </svg>
                                                                    </span>
                                                <!--end::Svg Icon-->
                                            </a>

                                           <?php /*
                                            <td>
    <form action="{{url('admin/sections').'/'.$r->id }}" method="post">
                                        @method('DELETE')
                                        <button onclick="return confirm('هل انت متأكد أنك تريد حذف العنصر');" style="border: 0px; background:none; color: white">
                                            <i class="fas fa-trash"></i>
                                            </button>
                                        @csrf
                                    </form>
                                        </td> */ ?>
                                        </td>
                                    </tr> @endforeach </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/eservices-orders.js') }}"></script>
@endsection
