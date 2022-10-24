v@extends('admin.layouts.adminLayout')
@section('title')
إعدادات البوت
@endsection
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin.chatbotSendMessages')}}" class="text-muted">ارسال رسالة واتساب</a>
    </li>


</ul>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">إعدادات البوت</div>

                <div class="card-body">
                    <form method="POST" action="{{route('admin.chatbotChangeSettings')}}">
                        @csrf



                        <div class="form-group row">

                            <label for="phone" class="col-md-4 col-form-label text-md-right ">توكين الواتساب</label>

                            <div class="col-md-6 ">
                                <input id="email" type="text" class="form-control text-right " dir="ltr" required autofocus autocomplete="off" placeholder="التوكين" name="token" value="{{ $token }}">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="phone" class="col-md-4 col-form-label text-md-right">رقم الإنستانس </label>

                            <div class="col-md-6">
                                <input id="email" type="number" class="form-control text-right" dir="ltr" required autocomplete="off" placeholder="رقم الانستانس" value="{{ $instance }}" name="instance">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="time_to_life" class="col-md-4 col-form-label text-md-right"> عمر الجلسة بالدقائق </label>

                            <div class="col-md-6">
                                <input id="time_to_life" type="number" class="form-control text-right" dir="ltr" required autocomplete="off" placeholder="عمر االجلسة بالدقائق" value="{{ $time_to_life ?? 20 }}" name="time_to_life">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label for="phone" class="col-md-4 col-form-label text-md-right">رابط الويب هوك</label>


                            <div class="col-md-6">
                                <input id="email" type="url" size="30" class="form-control text-right @error('email') is-invalid @enderror" dir="ltr" autocomplete="off" autofocus placeholder="مثل: https://muamlah.com/admin/webhook" value="{{ $webhook }}" name="webhook">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="webhook" class="col-md-4 col-form-label text-md-right">أرقام المشرفين على المجموعات: </label>
                            <div class="col-md-6">
                                <textarea placeholder="  أرقام المشرفين على المجموعات " name="group_supervisors" class="form-control col-xs-12" dir="ltr" rows="7" cols="50" required >{{ $group_supervisors ?? '' }}</textarea>
                            </div>
                        </div>



                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ التغييرات</button>
                            <a href="{{route('admin.admins.index')}}" class="btn btn-white">رجوع</a>

                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






@endsection
@section('script')
<script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/messages.js') }}"></script>
<script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.3.0/dist/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
@endsection
