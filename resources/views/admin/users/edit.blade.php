@extends('admin.layouts.adminLayout')
@section('title') الاعضاء
@endsection


@if($user->level == 'user')
    @section('headings')
        @include('admin.include.headings',[

            'title1'        => ' قائمة العملاء',
            'link1'         => route('admin.indexUser'),
            'title2'        => 'تعديل عضو',
            'link2'         => 'javascript:;',

        ])
    @endsection
@else
    @section('headings')
        @include('admin.include.headings',[

            'title1'        => ' مقدمي الخدمات',
            'link1'         => route('admin.indexProvider'),
            'title2'        => 'تعديل عضو',
            'link2'         => 'javascript:;',

        ])
    @endsection
@endif



@section('content')
    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card card-custom">

                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">تعديل عضو</h3>
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
                    <form method="post" action="{{route('admin.users.update',$user->id)}}"
                          enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}
                    {{ method_field('PUT')}}
                    <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-bold fs-6">الصورة الشخصية</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9">
                                    <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{asset('admin-file/assets/media/users/blank.png')}})">
                                        <div class="image-input-wrapper"></div>
                                        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="اختر صورة">
                                            <i class="flaticon2-pen icon-sm text-muted"></i>
                                            <input type="file" id="img" name="img" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="profile_avatar_remove" />
                                        </label>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="ازالة الصورة">
															<i class="flaticon-close icon-xs text-muted"></i>
														</span>
                                        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="ازالة الصورة">
															<i class="flaticon-close icon-xs text-muted"></i>
														</span>
                                    </div>
                                    <span class="form-text text-muted">النوع المسموح بة هي (.png, .jpg, .jpeg) و واكثر حجم مسموح بة ( 2M)</span>

                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">

                                <label class="col-lg-3 col-form-label required fw-bold fs-6">الاسم</label>

                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid"  value="{{@$user->name}}" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">

                                <label class="col-lg-3 col-form-label required fw-bold fs-6">

                                     كود الخصم [<a href="javascript:;" onclick="generateCode();"> توليد كود جديد </a>] </label>

                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="reference_code" class="form-control form-control-lg form-control-solid"  value="{{@$user->reference_code}}" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-bold fs-6">
                                    <span class="required">الموبايل</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9 fv-row">
                                    <input type="number" name="phone" class="form-control form-control-lg form-control-solid"  value="{{@$user->phone}}" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-bold fs-6">
                                    <span class="required">الرصيد المتاح</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9 fv-row">
                                    <input type="number" name="available_balance"  min="0"  class="form-control form-control-lg form-control-solid"  value="{{@$user->available_balance}}" />
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-bold fs-6">
                                    <span class="required">رصيد الطلبات</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9 fv-row">
                                    <input type="number" name="pinding_balance" min="0" class="form-control form-control-lg form-control-solid"  value="{{@$user->pinding_balance}}" />
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-bold fs-6">
                                    <span class="required">الايميل</span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-9 fv-row">
                                    <input type="email" name="email" class="form-control form-control-lg form-control-solid" value="{{@$user->email}}" />
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">نوع العضو</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                    <!--begin::Options-->
                                    <div class="d-flex align-items-center mt-3">
                                        <!--begin::Option-->
                                        <label class="form-check form-check-inline form-check-solid me-5">
                                            <input class="form-check-input" name="level" type="radio" value="user"@if(@$user->level == 'user') checked @endif />
                                            <span class="fw-bold ps-2 fs-6">عميل</span>
                                        </label>
                                        <!--end::Option-->
                                        <!--begin::Option-->
                                        <label class="form-check form-check-inline form-check-solid">
                                            <input class="form-check-input" name="level" type="radio" value="provider" @if(@$user->level == 'provider') checked @endif  />
                                            <span class="fw-bold ps-2 fs-6">مقدم خدمة</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Options-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="row mb-0">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">الحالة </label>
                                <!--begin::Label-->
                                <!--begin::Label-->
                                <div class="col-lg-8 d-flex align-items-center">
                                    <div class="form-check form-check-solid form-switch fv-row">
                                        <input class="form-check-input w-45px h-30px" type="checkbox"  name="status" value="{{@$user->status}}" @if($user->status == 'active') checked @endif />
                                        <label class="form-check-label" for="allowmarketing"></label>
                                    </div>
                                </div>
                                <!--begin::Label-->
                            </div>
                            <div class="row mb-6" style="margin-top: 15px">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-bold fs-6">هوية موثقة
                                    @if($user->getFile() != '')
                                    <a href="{{$user->getFile()}}" download="id-{{$user->full_name}}">
                                        [ تنزيل الهوية ]
                                    </a>
                                    @endif
                                </label>

                                <div class="col-lg-9 fv-row">
                                    <select class="form-control form-control-lg form-control-solid" name="verified">
                                        <option value=""></option>
                                        <option {{$user->verified == '1' ? 'selected' : ''}} value="1">نعم</option>
                                        <option {{$user->verified == '0' ? 'selected' : ''}} value="0">لا</option>
                                    </select>
                                </div>
                                <!--begin::Label-->
                            </div>
                            <div class="row mb-6" style="margin-top: 15px">
                                <!--begin::Label-->
                                <label class="col-lg-3 col-form-label fw-bold fs-6">وكيل
                                    @if($user->getCommercialRegister() != '')
                                    <a href="{{$user->getCommercialRegister()}}" download="cr-{{$user->full_name}}">
                                        [ تنزيل السجل التجاري]
                                    </a>
                                    @endif
                                </label>
                                <!--begin::Label-->
                                <!--begin::Label-->
                                <div class="col-lg-9 fv-row">
                                    <select class="form-control form-control-lg form-control-solid" name="is_agent">
                                        <option value=""></option>
                                        <option {{$user->is_agent == '1' ? 'selected' : ''}} value="1">نعم</option>
                                        <option {{$user->is_agent == '0' ? 'selected' : ''}} value="0">لا</option>
                                    </select>
                                </div>
                                <!--begin::Label-->
                            </div>
                            <div class="row mb-6" style="margin-top: 15px">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">امكانية سحب الرصيد</label>
                                <div class="col-lg-9 fv-row">
                                    <select class="form-control form-control-lg form-control-solid" name="balance_withdrawal">
                                        <option value=""></option>
                                        <option {{$user->balance_withdrawal == 'yes' ? 'selected' : ''}} value="yes">نعم</option>
                                        <option {{$user->balance_withdrawal == 'no' ? 'selected' : ''}} value="no">لا</option>
                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-center py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">تعديل</button>
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
<script>
     function makeid(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}
function generateCode(){
    var code = makeid(6);
    $('input[name=reference_code]').val(code);
}
</script>
@endsection
