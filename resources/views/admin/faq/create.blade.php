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
                    <h3 class="fw-bolder m-0">سؤال جديد - الأسئلة والأجوبة</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="post" action="{{route('admin.faq.store')}}"
                    class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}

                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        @if(session()->has('success'))
                        <h3 style="color:green; text-align:center;"> تم انشاء السؤال بنجاح </h3>
                        <br>
                        @endif
                        @if($errors->any())
                            {!! implode('', $errors->all('<div style="color: red; font-weight: bolder; font-size: 18px; text-align: center;">:message</div>')) !!}
                        @endif
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">مخصص لـ</label>

                            <div class="col-lg-9 fv-row">
                                <select name="type" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    @foreach($types as $key=>$type)
                                        <option  value="{{$key}}" >{{$type['title']}}</option>
                                   @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">السؤال </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="question"
                                    class="form-control form-control-lg form-control-solid" value="" /> 
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">الجواب </label>
                            <div class="col-lg-9 fv-row">
                                    <textarea name="answer" id="kt-tinymce-4" class="form-control form-control-lg form-control-solid"></textarea>
                            </div>
                            <!--end::Col-->
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
