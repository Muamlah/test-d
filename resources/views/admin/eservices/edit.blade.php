@extends('admin.layouts.adminLayout') @section('title') اقسام الخدمات الالكترونية
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' إدارة الخدمات',
        'link1'         => route('admin.eservices.list'),
        'title2'        => 'تعديل خدمة',
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
                    <h3 class="fw-bolder">تعديل قسم خدمات الكترونية</h3>
                </div>
                <div class="card-toolbar">
                    <a class="btn btn-success mr-2" href="{{route('admin.eservices.list')}}">
                        ادارة الخدمات
                    </a>
                </div>
                <!--end::Card title-->
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="post" action="{{url('admin/e_services/').'/'.$eservices->id.'/edit'}}" enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}

                    @method('PUT')
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->

                        @if(session()->has('success'))
                        <h3 style="color:green; text-align:center;"> تم التحديث بنجاح </h3>
                        <br>
                        @endif


                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">قسم الخدمة</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <select name="section_id" class="form-control form-control-lg form-control-solid">
                                    <option value="{{$eservices->section_id}}">{{$eservices->sections->name}}</option>

                                    @foreach($sections as $r)
                                    <option value="{{$r->id}}">{{$r->name}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <!--end::Col-->
                        </div>


                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">اسم الخدمة</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="service_name" value="{{$eservices->service_name}}" class="form-control form-control-lg form-control-solid" />
                            </div>
                            <!--end::Col-->
                        </div>

                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">شعار الخدمة</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <img src="{{asset('storage').'/'.$eservices->img}}" style="height: 50px; width: 50px;">
                                <input type="file" name="img" value="{{$eservices->img}}" class="form-control form-control-lg form-control-solid" />
                            </div>
                            <!--end::Col-->
                        </div>



{{--                        <div class="row mb-6">--}}
{{--                            <!--begin::Label-->--}}
{{--                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">سعر الخدمة</span> </label>--}}
{{--                            <!--end::Label-->--}}
{{--                            <!--begin::Col-->--}}
{{--                            <div class="col-lg-9 fv-row">--}}
{{--                                <input type="number" name="price" value="{{$eservices->price}}" class="form-control form-control-lg form-control-solid" />--}}
{{--                            </div>--}}
{{--                            <!--end::Col-->--}}
{{--                        </div>--}}



                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">تفاصيل الخدمة</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <textarea name="details" class="form-control form-control-lg form-control-solid">{{$eservices->details}}</textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">خطوات تنفيذ الخدمة </label>
                            <div class="col-lg-9 fv-row">
                                <textarea name="how_do" id="kt-tinymce-4" class="form-control form-control-lg form-control-solid">{{$eservices->how_do}}</textarea>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">شروط و احكام </label>
                            <div class="col-lg-9 fv-row">
                                <textarea name="policies" id="kt-tinymce-3" class="form-control form-control-lg form-control-solid">{{$eservices->policies}}</textarea>
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
</div>
@endsection
@section('script')
@include('admin.include.script.script_form')
@endsection
