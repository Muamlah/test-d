@extends('admin.layouts.adminLayout') @section('title') الخدمات الالكترونية
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات الخدمات الالكترونية',
        'link1'         => route('admin.eservices_orders_list'),
        'title2'        => 'تعديل الخدمة الإلكترونية',
        'link2'         => 'javascript:;',

    ])
@endsection

@section('content')

<div class="post fs-base d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div class="card card-custom">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title">
                    <h3 class="fw-bolder">تعديل خدمات الكترونية</h3> 
                </div>
                <div class="card-toolbar">
                    <a class="btn btn-success mr-2" href="{{route('admin.eservices_orders_list')}}">
                        طلبات الخدمات الإلكترونية
                    </a>
                </div>
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="post" action="{{url('admin/eservices_orders/').'/'.$eservices_orders->id.'/edit'}}" enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
                 {{ csrf_field() }}

                 @method('PUT')
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->

                        @if(session()->has('success'))
                            <h3 style="color:green; text-align:center;"> تم التحديث بنجاح </h3>
                            <br>
                        @endif
                        @if(session()->has('error'))
                            <h3 style="color:red; text-align:center;"> لايمكن تغيير الحالة لأنه لايوجد مقدم خدمة مستلم الطلب </h3>
                            <br>
                        @endif



                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">حالة الطلب</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                        <input type="hidden" name="eservice_id"
                        value="{{$eservices_orders->eservice_id}}">

                                <select name="status" class="form-control form-control-lg form-control-solid">


                                    @foreach($status as $item)
                                        <option @if($item->id == $eservices_orders->status) {{'selected'}} @endif value="{{$item->id}}"> {{$item->name}}</option>
                                    @endforeach

                                </select>

                                 </div>
                            <!--end::Col-->
                        </div>


                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">رقم العميل</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="number" readonly name="name" value="{{!empty($eservices_orders->users) ? $eservices_orders->users->phone : ''}}" class="form-control form-control-lg form-control-solid" /> </div>
                            <!--end::Col-->
                        </div>

                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">رقم مقدم الخدمة</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="number" readonly name="name" value="{{!empty($eservices_orders->providers) ? $eservices_orders->providers->phone : ''}}" class="form-control form-control-lg form-control-solid" /> </div>
                            <!--end::Col-->
                        </div>

                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">تفاصيل الطلب</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <textarea name="details" class="form-control form-control-lg form-control-solid">{{$eservices_orders->details}}</textarea>
                                 </div>
                            <!--end::Col-->
                        </div>

                        <!--end::Input group-->
                        <!--begin::Input group-->

                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                       <!-- <button type="reset" class="btn btn-white btn-active-light-primary me-2">Discard</button> -->
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ التغييرات</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</div> @endsection
