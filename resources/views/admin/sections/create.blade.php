@extends('admin.layouts.adminLayout') @section('title') الخدمات الالكترونية
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' إدارة أقسام الخدمات الإلكترونية',
        'link1'         => route('admin.section_list'),
        'title2'        => 'إضافة قسم',
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
                <div class="card-title ">
                    <h3 class="fw-bolder ">تعديل قسم خدمات الكترونية</h3> 
                </div>
                <div class="card-toolbar">
                    <a class="btn btn-success mr-2" href="{{route('admin.section_list')}}">
                        ادارة الأقسام
                    </a>
                </div>
                <!--end::Card title-->
            </div>
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">قسم جديد - الخدمات الالكترونية</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="post" action="{{url('admin/sections/create')}}" enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}

                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->

                        @if(session()->has('success'))
                        <h3 style="color:green; text-align:center;"> تم انشاء القسم بنجاح </h3>
                        <br>
                        @endif


                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">اسم القسم </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid" value="" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->

                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6"> <span class="required">الصورة</span> </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="file" name="img" class="form-control form-control-lg form-control-solid" value="" />
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
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">انشاء القسم</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</div> @endsection