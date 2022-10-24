@extends('admin.layouts.adminLayout')
@section('title') الاعضاء
@endsection

@if($user->level == 'user')
    @section('headings')
        @include('admin.include.headings',[

            'title1'        => ' قائمة العملاء',
            'link1'         => route('admin.indexUser'),
            'title2'        => 'اعادة تعيين كلمة المرور',
            'link2'         => 'javascript:;',

        ])
    @endsection
@else
    @section('headings')
        @include('admin.include.headings',[

            'title1'        => ' مقدمي الخدمات',
            'link1'         => route('admin.indexProvider'),
            'title2'        => 'اعادة تعيين كلمة المرور',
            'link2'         => 'javascript:;',

        ])
    @endsection
@endif

@section('content')
    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container">

            @if($errors->any())
                @if($errors->first() == 'success')
                    <div class="btn btn-primary" style="width: 100%;text-align: right;margin-bottom: 10px;">
                        <ul>
                            <li>تم الإرسال بنجاح</li>
                        </ul>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{$errors->first()}}</li>
                        </ul>
                    </div>
                @endif
            @endif

            <div class="card card-custom">

                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">إعادة تعيين كلمة المرور للمستخدم {{$user->name}}</h3>
                    </div>
                    @if($user->level == 'user')
                        <div class="card-toolbar">
                            <a class="btn btn-success mr-2" href="{{route('admin.indexUser')}}">
                                العملاء
                            </a>
                        </div>
                    @else
                        <div class="card-toolbar">
                            <a class="btn btn-success mr-2" href="{{route('admin.indexProvider')}}">
                                مقدمي الخدمات
                            </a>
                        </div>
                    @endif
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form method="post" action="{{route('admin.users.resetPasswordPost',$user->id)}}" class="form" role="form" >
                        {{ csrf_field() }}
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">طريقة التفعيل</label>
                                <div class="col-lg-9 fv-row">
                                    {{-- <input type="text" name="name" class="form-control form-control-lg form-control-solid"  value="{{@$user->name}}" /> --}}
                                    <select class="form-control form-control-lg form-control-solid" name="reset_password" style="padding: 5px">
                                        <option value="email">عن طريق البريدي اللإلكتروني</option>
                                        <option value="phone">عن طريق رقم الهاتف</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center py-6 px-9">
                            <button type="submit" class="btn btn-primary" >ارسل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script>

</script>
@endsection
