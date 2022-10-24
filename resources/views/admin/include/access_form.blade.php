@extends('admin.layouts.adminLayout')
@section('title') محفظة المنصة
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' كلمة المرور الإضافية',
        'link1'         => 'javascript:;',

    ])
@endsection

@section('content')
<div class="card">
    <div class="card-body border-top p-9">

        @if($errors->any())
            {!! implode('', $errors->all('<div style="color: red; font-weight: bolder; font-size: 18px; text-align: center;">:message</div>')) !!}
        @endif
        <form method="post" action="{{route('admin.admins.verify')}}" enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
            {{ csrf_field() }}
            {{-- {{dd(\Request::route()->getName())}} --}}
            <input type="hidden" name="type" value="{{$type}}">
            <div class="row mb-6">
                <!--begin::Label-->
                <label class="col-lg-3 col-form-label fw-bold fs-6">
                    <span class="required">كلمة المرور الإضافية</span>
                </label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-9 fv-row">
                    <input type="password" name="second_password" class="form-control form-control-lg form-control-solid" value="{{old('second_password')}}" />
                </div>
                <!--end::Col-->
            </div>
            <div class="card-footer d-flex text-center py-6 px-9">
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">تسجيل الدخول</button>
            </div>
        </form>
    </div>
</div>
@endsection