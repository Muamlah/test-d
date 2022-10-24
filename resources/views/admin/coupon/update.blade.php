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
                    <h3 class="fw-bolder m-0"> التسويق بالعمولة</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="post" action="{{route('admin.coupon.save',['coupon' => $coupon->id])}}"
                    class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}

                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        @if(session()->has('success'))
                            <h3 style="color:green; text-align:center;"> تم تعديل البطاقة بنجاح </h3>
                            <br>
                        @endif
                        @if(session()->has('error'))
                            <h3 style="color:red; text-align:center;"> {{session()->get('error')}} </h3>
                            <br>
                        @endif
                        @if(session()->has('used'))
                            <h3 style="color:red; text-align:center;"> يرجى تغيير الكود لأنه مستخدم في كوبون آخر </h3>
                            <br>
                        @endif
                        @if($errors->any())
                            {!! implode('', $errors->all('<div style="color: red; font-weight: bolder; font-size: 18px; text-align: center;">:message</div>')) !!}
                        @endif
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">نوع البطاقة</label>

                            <div class="col-lg-9 fv-row">
                                <select name="type" id="type" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    @foreach($types as $key=>$type)
                                        <option  value="{{$key}}" @if(@$coupon->type == $key) selected @endif>{{$type['title']}}</option>
                                   @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">الرمز </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="code"
                                    class="form-control form-control-lg form-control-solid" value="{{$coupon->code}}"  /> 
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6"  id="discount_type_div">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">نوع الحسم</label>

                            <div class="col-lg-9 fv-row">
                                <select name="discount_type" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    @foreach($discount_types as $key=>$type)
                                        <option  value="{{$key}}" @if(@$coupon->discount_type == $key) selected @endif>{{$type['title']}}</option>
                                   @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">قيمة الحسم </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="discount"
                                    class="form-control form-control-lg form-control-solid" value="{{$coupon->discount}}" /> 
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6" id="owner_discount">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">قيمة الخصم الخاصة بالمستخدم صاحب الكود </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="owner_discount"
                                    class="form-control form-control-lg form-control-solid" value="{{$coupon->owner_discount}}" placeholder="اترك الحقل فارغ في حال لا يوجد حسم للمستخدم صاحب الكود"/> 
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6" id="user_phone">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">رقم هاتف المستخدم صاحب الكود </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="user_phone"
                                    class="form-control form-control-lg form-control-solid" value="{{$user_phone}}" placeholder="اترك الحقل فارغ في حال لا يوجد حسم للمستخدم صاحب الكود"/> 
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6"  id="max_discount_div">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">الحد الأعلى للحسم </label>
                            <div class="col-lg-9 fv-row">
                                <input type="text" name="max_discount"
                                    class="form-control form-control-lg form-control-solid" value="{{$coupon->max_discount}}" /> 
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">عدد المستفيدين </label>
                            <div class="col-lg-9 fv-row">
                                <input type="number" name="instances_count"
                                    class="form-control form-control-lg form-control-solid" value="{{$coupon->instances_count}}" /> 
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">عدد مرات الإستخدام </label>
                            <div class="col-lg-9 fv-row">
                                <input type="number" name="number_of_use"
                                    class="form-control form-control-lg form-control-solid" value="{{$coupon->number_of_use}}" /> 
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label required fw-bold fs-6">تاريخ إنتهاء الصلاحية </label>
                            <div class="col-lg-9 fv-row">
                                <input type="date" name="end_date"
                                    class="form-control form-control-lg form-control-solid" value="{{\Carbon\Carbon::parse($coupon->end_date)->format('Y-m-d')}}" /> 
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
@if($coupon->type == 'gift')
    <script>
        $('#max_discount_div').hide();
        $('#discount_type_div').hide();
        $('#owner_discount').hide();
    </script>
@endif
<script>
    $('#type').change(function(){
        var data= $(this).val();
        if(data == "gift"){
            $('#max_discount_div').hide();
            $('#discount_type_div').hide();
            $('#owner_discount').hide();
        }else{
            $('#max_discount_div').show();
            $('#discount_type_div').show();
            $('#owner_discount').show();

        }            
    });
</script>
@include('admin.include.script.script_form')
@endsection
