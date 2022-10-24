@extends('admin.layouts.adminLayout') @section('title') الأسئلة
@endsection
@section('content')
<div class="post fs-base d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0"> اعدادت التواصل</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="post" action="{{route('admin.config.save',['config' => $config->id])}}"
                    class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}

                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        @if(session()->has('success'))
                            <h3 style="color:green; text-align:center;"> تم التعديل بنجاح </h3>
                            <br>
                        @endif
                        @if(session()->has('error'))
                            <h3 style="color:red; text-align:center;"> {{session()->get('error')}} </h3>
                            <br>
                        @endif
                        @if($errors->any())
                            {!! implode('', $errors->all('<div style="color: red; font-weight: bolder; font-size: 18px; text-align: center;">:message</div>')) !!}
                        @endif
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">الاسم </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="name"
                                    class="form-control form-control-lg form-control-solid" value="{{$config->name}}"  /> 
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">القيمة </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="val"
                                    class="form-control form-control-lg form-control-solid" value="{{$config->val}}"  /> 
                            </div>
                        </div><div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">الرمز </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="key"
                                    class="form-control form-control-lg form-control-solid" value="{{$config->key}}"  /> 
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <!-- <button type="reset" class="btn btn-white btn-active-light-primary me-2">Discard</button> -->
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ
                            البيانات</button>
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
