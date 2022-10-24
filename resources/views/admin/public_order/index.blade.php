@extends('admin.layouts.adminLayout')
@section('title')
قائمة طلبات الخدمات الإلكترونية
@endsection @section('content')
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
                        <span class="card-label fw-bolder fs-3 mb-1">قائمة طلبات الخدمات الإلكترونية</span>
                    </h3>
                </div>
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
                                    <th class="min-w-120px">#</th>
                                    <th class="min-w-120px">رقم العميل</th>
                                    <th class="min-w-120px">عنوان الطلب</th>
                                    <th class="min-w-150px">تفاصيل الطلب</th>
                                    <th class="min-w-120px">تاريخ الطلب</th>
                                    <th class="min-w-120px">الحالة</th>
                                    <th class="min-w-100px text-end">العمليات</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach($orders as $one)
                                <tr>
                                    <td> {{@$one->id}} </td>
                                    <td> <a href="https://api.whatsapp.com/send?phone=966{{substr($one->user->phone,1)}}" class="text-dark fw-bolder fs-6">{{@$one->user->phone}}<i class="fab fa-whatsapp whatsapp-icon"></i></a> </td>
                                    <td> <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{@$one->title}}</a> </td>
                                    <td> <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{@$one->details}}</a> </td>
                                    <td class="text-dark fw-bolder text-hover-primary fs-6"> {{@$one->created_at}} </td>

                                    <td>
                                        @if($one->status == 1)
                                        <span class="badge badge-light-primary" style="font-weight: bolder;">{{@$one->st->name}}</span>
                                        @elseif($one->status == 2)
                                        <span class="badge badge-light-success" style="font-weight: bolder;">مفتوح</span>
                                        @elseif($one->status == 3)
                                        <span class="badge badge-light-warning " style="font-weight: bolder;">{{@$one->st->name}}</span>
                                        @elseif($one->status == 4)
                                        <span class="badge badge-light-success " style="font-weight: bolder;">{{@$one->st->name}}</span>
                                        @elseif($one->status == 5)
                                        <span class="badge badge-light-success " style="font-weight: bolder;">{{@$one->st->name}}</span>
                                        @elseif($one->status == 6)
                                        <span class="badge badge-light-danger " style="font-weight: bolder;">{{@$one->st->name}}</span>
                                        @elseif($one->status == 7)
                                        <span class="badge badge-light-danger " style="font-weight: bolder;">{{@$one->st->name}}</span>
                                        @endif

                                    </td>

                                    <td class="text-end">
                                        <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" data-toggle="modal" data-target="#kt_modal_new_address_{{$one->id}}">

                                            <!--begin::Svg Icon | path: icons/stockholm/Communication/Write.svg--><span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)" />
                                                    <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </td>
                                    <div class="modal fade" id="kt_modal_new_address_{{$one->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
                                        <!--begin::Modal dialog-->
                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                            <!--begin::Modal content-->
                                            <div class="modal-content">
                                                <!--begin::Form-->
                                                <form action="{{route('admin.public_orders.updateStatus',$one->id)}}" method="post" class="form" action="#" id="kt_modal_new_address_form">
                                                    @csrf
                                                    @method('patch')
                                                    <!--begin::Modal header-->
                                                    <div class="modal-header" id="kt_modal_new_address_header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="mb-0">تعديل حالة الطلب</h2>
                                                        <!--end::Modal title-->
                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                            <!--begin::Svg Icon | path: icons/stockholm/Navigation/Close.svg-->
                                                            <span class="svg-icon svg-icon-2x">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                    <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)" fill="#000000">
                                                                        <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                                                        <rect fill="#000000" opacity="0.5" transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)" x="0" y="7" width="16" height="2" rx="1" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                                    <!--end::Modal header-->
                                                    <!--begin::Modal body-->
                                                    <div class="modal-body py-10 px-lg-17">
                                                        <!--begin::Scroll-->
                                                        <div class="scroll-y me-n7 pe-7" id="kt_modal_new_address_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_address_header" data-kt-scroll-wrappers="#kt_modal_new_address_scroll" data-kt-scroll-offset="300px">

                                                            <!--end::Input group-->
                                                            <!--begin::Input group-->
                                                            <div class="d-flex flex-column mb-5 fv-row">
                                                                <!--begin::Label-->
                                                                <label class="d-flex align-items-center fs-5 fw-bold mb-2">
                                                                    <span class="required">حالة الطلب</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Select-->
                                                                <select name="status" data-placeholder="اختر .." class="form-select form-select-solid">
                                                                    <option value="">اختر ..</option>
                                                                    @foreach($status as $st)
                                                                    <option value="{{$st->id}}" @if($st->id == $one->status) selected @endif>{{$st->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <!--end::Select-->
                                                            </div>

                                                        </div>
                                                        <!--end::Scroll-->
                                                    </div>
                                                    <!--end::Modal body-->
                                                    <!--begin::Modal footer-->
                                                    <div class="modal-footer flex-center">

                                                        <button type="submit" id="kt_modal_new_address_submit" class="btn btn-primary">
                                                            <span class="indicator-label">تعديل</span>
                                                        </button>

                                                        <button type="reset" id="kt_modal_new_address_cancel" class="btn btn-white me-3">رجوع</button>

                                                        <!--end::Button-->
                                                    </div>
                                                    <!--end::Modal footer-->
                                                </form>
                                                <!--end::Form-->
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                @endforeach
                            </tbody>
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
