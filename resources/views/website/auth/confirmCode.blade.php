@extends('website.layout')
@section('content')
<div class="page-content header-clear-medium">
    {{-- @if ($message = Session::get('error') )--}}
    {{-- <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">--}}
    {{-- <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>--}}
    {{-- <h4 class="text-uppercase color-white">انت لم تقم بتسجيل الدخول !</h4>--}}
    {{-- <strong class="alert-icon-text">يجب عليك تسجيل الدخول اولا ليتم اتمام هذه العملية</strong>--}}
    {{-- <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">--}}
    {{-- &times;--}}
    {{-- </button>--}}
    {{-- </div>--}}
    {{-- @endif--}}

    @if (count($errors) > 0)
    <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
        <h4 class="text-uppercase color-white"><strong class="mr-0 pr-0">{{'خطأ في إدخال البيانات '}}!</strong></h4>

        @foreach ($errors->all() as $error)
        <strong class="alert-icon-text">{{ $error }}</strong><br>
        @endforeach
        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif


    <div class="card card-style bg-theme pb-0">
        <div class="content">
            <div class="text-center mb-3">
                <h3 class="font-900 font-35">كود التفعيل</h3>
                @if (Str::contains(Request::url(),'email'))
                <p class="bottom-0 text-center color-highlight font-11"> الرجاء إدخال رمز التحقق المكون من 4 أرقام الذي تم ارساله الى البريد الاكتروني السابق الخاص بك.</p>

                @elseif (Str::contains(Request::url(),'phone'))
                    @if (Auth::user()->activation_type=='sms')
                        <p class="bottom-0 text-center color-highlight font-11"> الرجاء إدخال رمز التحقق المكون من 4 أرقام الذي تم ارساله الى رقم الهاتف .</p>

                    @else
                        <p class="bottom-0 text-center color-highlight font-11"> الرجاء إدخال رمز التحقق المكون من 4 أرقام الذي تم ارساله الى البريد الاكتروني .</p>

                    @endif
                @elseif (Str::contains(Request::url(),'code'))

                <p class="bottom-0 text-center color-highlight font-11"> الرجاء إدخال رمز التحقق المكون من 4 أرقام الذي تم ارساله الى رقم الهاتف وبريدك الالكتروني السابقين.</p>


                @endif


            </div>
            <form method="post" action="{{Str::contains(Request::url(),'code')? route('user.verification.verify',['type' => 'codes']):route('phoneVerification.verify') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="input-style has-icon input-style-2 input-required ">
                    <i class="input-icon fa fa-user color-theme"></i>
                    <span>كود التفعيل</span>
                    <em>(مطلوب)</em>
                    <input type="number" name="verification_code" placeholder="كود التفعيل">
                </div>

                <button type="submit" class="btn btn-m mt-2 mb-4 btn-full bg-green-c text-uppercase font-900">تفعيل الحساب</button>
            </form>
        </div>

    </div>



</div>

@endsection
