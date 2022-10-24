@extends('website.layout')
@section('content')
<div class="page-content header-clear-medium">
    @if (Session::get('success') )
        <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
            <span><i class="fa fa-check"></i></span>
            <h4 class="text-uppercase color-white">{{Session::get('success')}} !</h4>
            <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
        <h4 class="text-uppercase color-white"><strong>{{'خطأ في إدخال البيانات '}}!</strong></h4>

        @foreach ($errors->all() as $error)
        <strong class="alert-icon-text">{{ $error }}</strong><br>
        @endforeach
        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif


    <div class="card card-style bg-theme pb-0">
        <div class="content">
            <div class="text-center mb-3">
                <h3 class="font-900 font-35">تسجيل الدخول</h3>
                <p class="bottom-0 text-center color-highlight font-11">مرحبا الرجاء إدخال بيانات الدخول الخاصة بك أدناه.</p>

            </div>
            <form method="post" action="{{ route('login') }}" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                <input type="hidden" value="true" name="remember" >
                <div class=" input-style input-style-2 has-icon input-required">
                    <i class="fa input-icon fa-phone"></i>
                    <span class="color-highlight input-style-1-inactive">رقم موبايل المستخدم</span>
                    <em>(مطلوب)</em>
                    <input type="tel" name="phone" required  placeholder="رقم الموبايل">
                </div>
                <div class="input-style input-style-2  has-icon input-required">
                    <i class="fa input-icon fa-lock"></i>
                    <span class="color-highlight">كلمة المرور</span>
                    <em>(مطلوب)</em>
                    <input type="password" id="psw" name="password" required class="validate password">
                </div>
                <div class="row">
                    <div class="col-9">
                        <a data-menu="menu-signup" href="{{route('register')}}" class="float-right font-18">تسجيل حساب جديد</a>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-3">
                        <a href="{{route('password.request')}}" data-menu="menu-forgot" class="font-18">هل نسيت كلمة المرور؟</a>
                    </div>

                </div>
                <button type="submit" class="btn btn-m mt-2 mb-4 btn-full bg-green-c text-uppercase font-900">تسجيل الدخول</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    document.querySelector(".password").addEventListener("paste", function(e) {
        e.preventDefault();
        var text = e.clipboardData.getData("text/plain");
        document.execCommand("insertHTML", false, text);
    });
</script>
@endsection
