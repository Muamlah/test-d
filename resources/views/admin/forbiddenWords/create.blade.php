@extends('admin.layouts.adminLayout')
@section('title') الكلمات الممنوعة
@endsection
@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            الاعدادات
        </li>
        <li class="breadcrumb-item text-muted">
            قائمة الكلمات الممنوعة
        </li>
    </ul>
@endsection
@section('content')
    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">اضافة</h3> </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form method="post" action="{{route('admin.forbidden_words.store')}}" enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}

                    <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            @if(session()->has('success'))
                                <h3 style="color:green; text-align:center;"> تم الانشاء بنجاح </h3>
                                <br>
                            @endif


                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">الكلمة</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid" value="" /> </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">سبب المنع</label>
                                <div class="col-lg-9 fv-row">
                                    <textarea name="description" class="form-control form-control-lg form-control-solid"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ البيانات</button>
                            <a href="{{route('admin.forbidden_words.index')}}" class="btn btn-white">رجوع</a>

                        </div>
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
