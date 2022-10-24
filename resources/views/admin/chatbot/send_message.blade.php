@extends('admin.layouts.adminLayout')
@section('title')
إرسال رسائل
@endsection
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
    </li>
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin.chatbotSettings')}}" class="text-muted">اعدادات البوت</a>
    </li>
</ul>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">إرسال رسائل للعملاء</div>

                <div class="card-body">
                    <form method="POST" action="{{  route('admin.chatbotSendMessages') }}">
                        @csrf
                        @if(session()->has('success'))
                        <h3 style="color:green; text-align:center;"> تم إرسال الرسالة بنجاح </h3>
                        <br>
                        @endif
                        @if(session()->has('fail'))
                        <h3 style="color:red; text-align:center;"> لم يتم إرسال الرسالة، يوجد خطأ ما،  </h3>
                        <br>
                        @endif


                        <div class="form-group row">

                            <label for="phone" class="col-md-4 col-form-label text-md-right">أدخل رقم الموبايل بدون علامة </label>

                            <div class="col-md-6">
                                <input id="phone" type="chatbot_phone" class="form-control @error('email') is-invalid @enderror text-right" dir="ltr" name="chatbot_phone" value="{{ $email ?? old('email') }}" required autocomplete="off" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="webhook" class="col-md-4 col-form-label text-md-right">نص الرسالة: </label>
                            <div class="col-md-6">
                                <textarea placeholder="نص الرسالة " name="chatbot_message" class="form-control col-xs-12" rows="7" cols="50" required></textarea>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" name="submit" class="btn btn-primary" id="kt_account_profile_details_submit">إرسال </button>
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
